<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateDeliveryItems;
use App\Models\Item;
use App\Models\OrderItem;
use App\Models\PackingOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PackingAndUnpackingController extends Controller
{
    public function index(){
        $PackingAndUnpackingDetails = session('PackingAndUnpackingDetails');        
        return inertia('General/PackingUnpackingQuote')->with(['PackingAndUnpackingDetails'=>$PackingAndUnpackingDetails]);
    }

    public function validateDetails(Request $request){        
        $validated = $request->validate([
            'postCode' => 'required|string|regex:/^[A-Za-z0-9\- ]+$/',
            'address' => 'required|string',
            'serviceType' => 'required|string|in:packing,unpacking',
            'date' => 'required|date|after_or_equal:today'
        ]);

        session()->put('packingUnpackingDetails', $validated);

        return response()->json(['message' => 'Submitted successfully'],200);
    }

    public function validateItems(ValidateDeliveryItems $request)
    {
        $validated = $request->validated();

        session()->put('packingUnpackingItems', $validated['items']);

        return response()->json(['message' => 'items validated successfully']);
    }

    public function validateUserInfo(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',  
            'phone' => ['required', 'string', 'regex:/^\+?[0-9]{1,3}?[-.\s]?\(?[0-9]{2,4}\)?[-.\s]?[0-9]{3,4}[-.\s]?[0-9]{3,4}$/'],          
        ]);               
       
        session()->put('packingUnpackingUserInfo', $validated);

        return response()->json(['message' => 'user info validated successfully'],200);
    }

    public function fetchSummary()
    {
        $serviceDetails = session()->get('PackingAndUnpackingDetails');
        $items = session()->get('packingUnpackingItems');

        if (!$serviceDetails || !$items) {
            return response()->json(['error' => true, 'message' => 'Delivery details or items are missing'], 404);
        }                

        $data = [            
            'address' => $serviceDetails['address'],
            'serviceType' => $serviceDetails['serviceType'],
            'date' => $serviceDetails['date'],            
            'items' => $items,            
        ];

        return response()->json($data,200);
    }

    public function checkout()
    {        
        $order = $this->createOrder();           
        session()->forget(['packingUnpackingDetails','packingUnpackingItems','packingUnpackingUserInfo']);
        return response()->json(['redirect' => $this->buildWhatsAppMsg($order)]);
    }

    public function getDistanceBetweenPostcodes($postcodes)
    {
        $fromPostcode = $postcodes['from'];
        $toPostcode = $postcodes['to'];

        if (!$fromPostcode || !$toPostcode) {
            return [
                'error' => true,
                'message' => 'Pickup and delivery postcodes were not submitted.'
            ];
        }

        $accessToken = config('services.mapbox.token');

        // Generate cache key
        $cacheKey = 'distance_' . md5(strtolower(trim($fromPostcode)) . '_' . strtolower(trim($toPostcode)));

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        try {
            // Step 1: Geocode
            $fromResp = Http::get("https://api.mapbox.com/geocoding/v5/mapbox.places/" . urlencode($fromPostcode) . ".json", [
                'access_token' => $accessToken
            ]);
            $toResp = Http::get("https://api.mapbox.com/geocoding/v5/mapbox.places/" . urlencode($toPostcode) . ".json", [
                'access_token' => $accessToken
            ]);
        } catch (\Exception $e) {
            Log::error("Mapbox error: " . $e->getMessage());
            return [
                'error' => true,
                'message' => 'Failed to fetch coordinates from Mapbox.'
            ];
        }



        $fromData = $fromResp->json();
        $toData = $toResp->json();

        if (empty($fromData['features'][0]['center']) || empty($toData['features'][0]['center'])) {
            Log::error('Could not find coordinates for one or both postcodes.');
            return [
                'error' => true,
                'message' => 'Could not find coordinates for one or both postcodes.'
            ];
        }

        $fromCoord = $fromData['features'][0]['center']; // [lng, lat]
        $toCoord = $toData['features'][0]['center'];

        // Step 2: Get route
        try {
            $directionsResp = Http::get("https://api.mapbox.com/directions/v5/mapbox/driving/{$fromCoord[0]},{$fromCoord[1]};{$toCoord[0]},{$toCoord[1]}", [
                'access_token' => $accessToken,
                'geometries' => 'geojson'
            ]);
        } catch (\Exception $e) {
            Log::error("Mapbox error: " . $e->getMessage());
            return [
                'error' => true,
                'message' => 'Failed to fetch directions.'
            ];
        }


        $directionsData = $directionsResp->json();
        if (empty($directionsData['routes'])) {
            Log::error('No route found.');
            return [
                'error' => true,
                'message' => 'No route found.'
            ];
        }

        $distanceInMiles = $directionsData['routes'][0]['distance'] * 0.000621371; // meters to miles

        $responsePayload = [
            'distance_miles' => round($distanceInMiles, 2),            
            'duration' => $directionsData["routes"][0]["duration"] ? round($directionsData["routes"][0]["duration"] / 60) : 10,            
        ];

        Cache::put($cacheKey, $responsePayload, now()->addDay());

        return $responsePayload;
    }

    public function generateCost($items, $distance)
    {              
        $items_cost = 0;

        $itemIds = collect($items)->pluck('id')->all();
        $itemsFromDb = Item::whereIn('id', $itemIds)->get()->keyBy('id');

        foreach ($items as $item) {
            $unitPrice = optional($itemsFromDb->get($item['id']))->pricePerUnit ?? 0;
            $qty = $item['qty'] ?? 1;
            $items_cost += $unitPrice * $qty;
        }
        
        $baseFee = ($distance * config('app.rating', 0)) + $items_cost;
        $vat = config('app.vat_fee');
        $quote = $baseFee + (!is_null($vat) ? $baseFee * $vat : 0);
           
        return $quote;
    }

    public function createOrder(){
        $details = session()->get('packingUnpackingDetails');
        $items = session()->get('packingUnpackingItems');
        $userinfo = session()->get('packingUnpackingUserInfo');        

        if(!$details || !$items || !$userinfo){            
            return response()->json([
                'error' => true,
                'messsage' => 'Unable to find request details'
            ], 400);
        }

        $resp  = $this->getDistanceBetweenPostcodes([
            'from' => config('app.postCode'),
            'to' => $details['postCode']
        ]);

        if(!empty($resp['error'])){
            return response()->json($resp, 400);
        }

        $quote = $this->generateCost($items, $resp['distance_miles']);

        $order = new PackingOrder();    
        $order->service_type = $details['serviceType'];    
        $order->username = $userinfo['username'];
        $order->email = $userinfo['email'];
        $order->phone = $userinfo['phone'];
        $order->postCode = $details['postCode'];
        $order->address = $details['address'];
        $order->dateTime = $details['date'];
        $order->duration = $resp['duration'];
        $order->distance = $resp['distance_miles'];
        $order->items = json_encode($items);
        $order->quote_fee = $quote;
        $order->save();

        foreach ($items as $item) {
            OrderItem::create([
                'order_id' =>  $order->id,
                'item_id' => $item['id'],
                'qty' => $item["qty"],
            ]);
        }

        return $order;
    }

    public function buildWhatsAppMsg($order)
    {
        $stringItemsArr = [];
        foreach (json_decode($order->items, true) as $item) {
            $stringItemsArr[] = $item["qty"] !== null ? $item["qty"] . ' ' . $item["name"] : $item["name"];
        }

        $stringItems = join(', ', $stringItemsArr);

        $message = "Hello, My name is *{$order->username}*. I'm contacting you to request an instant quotation for {$order->service_type} services.\n" .
            "*Reference Number: {$order->order_refNo}*.\n" .
            "\n" .
            "Items*\n" .
            "{$stringItems}\n" .
            "\n" .
            "*Request details*\n" .
            "Address: {$order->order_pickUpAddress}\n" .
            "Post code: {$order->order_pickUpPostCode}\n" .            
            "Date: " . date('M d, Y', strtotime($order->dateTime)) . "\n" .            
            "\n" .
            "*Contact details*\n" .
            "Phone: {$order->phone}\n" .
            "Email: {$order->email}";
        // Encode the message
        $encodedMessage = urlencode($message);
        // Construct the WhatsApp URL
        return config('app.socials.whatsapp') . "?text={$encodedMessage}";
    }
}
