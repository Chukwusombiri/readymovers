<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateDeliveryDetails;
use App\Http\Requests\ValidateDeliveryItems;
use App\Mail\AdminOrderPaid;
use App\Mail\OrderPaidMail;
use App\Mail\OrderPaymentFailed;
use App\Models\Floor;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Traits\ConvertToMoney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class QuoteController extends Controller
{
    use ConvertToMoney;
    public function moveQuote(Request $request)
    {        
        $data = [            
            'allItems' => Item::all()->toArray(),
            'inputItems' => session()->get('delivery_items_details') ?? [],
            'floors' => Floor::select('id', 'name')->get()
        ];

        if ($postCode = $request->query('postCode')) {
            $data['postCode'] = $postCode;
        }

        if($request->status && $request->status === 'cancelled') $data['status'] = 'cancelled' ;        

        return inertia('General/MoveQuote')->with([
            'respData' => $data
        ]);
    }

    public function validateDeliveryDetails(ValidateDeliveryDetails $request)
    {
        $validated = $request->validated();
        session()->put('deliveryDetails', $validated);

        return redirect()->back();
    }


    public function validateDeliveryItems(ValidateDeliveryItems $request)
    {
        $validated = $request->validated();

        session()->put('items', $validated['items']);

        return response()->json(['success' => true, 'message' => 'Quote validated successfully']);
    }

    public function validateUserInfo(Request $request)
    {
        $data = $request->only(['username', 'email', 'phone']);

        $rules = [
            'username' => 'required|string',
            'email' => 'required|email',
            'phone' => ['required', 'string', 'regex:/^\+?[0-9]{1,3}?[-.\s]?\(?[0-9]{2,4}\)?[-.\s]?[0-9]{3,4}[-.\s]?[0-9]{3,4}$/']
        ];
        $messages = [
            'phone.regex' => 'The phone number format is invalid. It should include only digits, spaces, dashes, parentheses, and an optional country code.'
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();

        session()->put('userInfo', $validated);

        return response()->json(['success' => true, 'message' => 'user info validated successfully']);
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
            'route_geometry' => $directionsData['routes'][0]['geometry'],
            'duration' => $directionsData["routes"][0]["duration"] ? round($directionsData["routes"][0]["duration"] / 60) : 10,
            'fromCoord' => $fromCoord,
            'toCoord' => $toCoord
        ];

        Cache::put($cacheKey, $responsePayload, now()->addDay());

        return $responsePayload;
    }

    public function generateCostAndDistance($deliveryDetails, $items, $directionsData)
    {
        $miles = $directionsData['distance_miles'];
        $duration =  $directionsData['duration'];
        $fromCoord = $directionsData['fromCoord'];
        $toCoord = $directionsData['toCoord'];
        $items_cost = 0;

        $itemIds = collect($items)->pluck('id')->all();
        $itemsFromDb = Item::whereIn('id', $itemIds)->get()->keyBy('id');

        foreach ($items as $item) {
            $unitPrice = optional($itemsFromDb->get($item['id']))->pricePerUnit ?? 0;
            $qty = $item['qty'] ?? 1;
            $items_cost += $unitPrice * $qty;
        }

        $floorRate = config('app.floor_rate', 0);
        $elevatorRate = config('app.elevator_rate', 0);

        $pickUpMultiplier = optional(
            Floor::where('name', $deliveryDetails['pickUpFloor'])->first()
        )->multiplier ?? 1;

        $dropOffMultiplier = optional(
            Floor::where('name', $deliveryDetails['deliveryFloor'])->first()
        )->multiplier ?? 1;

        $pickUpFloorFee = $pickUpMultiplier * $floorRate;
        $dropOffFloorFee = $dropOffMultiplier * $floorRate;

        $pickAndDropFee = 0;
        $pickAndDropFee += $deliveryDetails['elevatorIsAvailableAtPickUp'] ? $elevatorRate : $pickUpFloorFee;
        $pickAndDropFee += $deliveryDetails['elevatorIsAvailableAtDelivery'] ? $elevatorRate : $dropOffFloorFee;

        $baseFee = ($miles * config('app.rating', 0)) + $items_cost + $pickAndDropFee;
        $vat = config('app.vat_fee');
        $quote = $baseFee + (!is_null($vat) ? $baseFee * $vat : 0);

        $upfrontRate = config('app.upfront', 0.5);
        $upfront = $quote * $upfrontRate;

        $data = [
            'distance_miles' => $miles,
            'quote' => $quote,
            'upfront' => $upfront,
            'duration' => $duration,
            'fromCoord' => $fromCoord,
            'toCoord' => $toCoord
        ];
        session()->put('costAndDistance', $data);
        return $data;
    }

    public function fetchSummary()
    {
        $deliveryDetails = session()->get('deliveryDetails');
        $items = session()->get('items');

        if (!$deliveryDetails || !$items) {
            return response()->json(['error' => true, 'restart' => true, 'message' => 'Delivery details or items are missing'], 400);
        }

        $routeData = $this->getDistanceBetweenPostcodes([
            'from' => $deliveryDetails['pickUpPostCode'],
            'to' => $deliveryDetails['deliveryPostCode']
        ]);

        if (!empty($routeData['error'])) {
            return response()->json(['error' => true, 'message' => $routeData['message']], 422);
        }

        $costAndDistance = $this->generateCostAndDistance($deliveryDetails, $items, $routeData);

        $data = [
            'distance_miles' => $costAndDistance['distance_miles'],
            'pickUpAddress' => $deliveryDetails['pickUpAddress'],
            'pickUpFloor' => $deliveryDetails['pickUpFloor'],
            'deliveryFloor' => $deliveryDetails['deliveryFloor'],
            'deliveryAddress' => $deliveryDetails['deliveryAddress'],
            'items' => $items,
            'quote' => round($costAndDistance['quote'], 2),
            'upfront' => round($costAndDistance['upfront'], 2),
        ];

        return response()->json($data, 200);
    }

    public function checkoutOrWhatsApp(Request $request)
    {
        $source = $request->input('source');
        $outcome = $this->createOrder();
        if ($outcome['error']) {
            return response()->json(['message' => $outcome['message']], 400);
        }
        $order = $outcome['order'];
        session()->forget(['deliveryDetails','costAndDistance','userInfo','items']);
        return response()->json(['redirect' => ($source === 'checkout' ? $this->createCheckOut($order) : $this->buildWhatsAppMsg($order))], 200);
    }


    public function createOrder()
    {
        $userInfo = session('userInfo');
        $deliveryDetails = session('deliveryDetails');
        $items = session('items');
        $costAndDistance = session('costAndDistance');

        if (!$userInfo || !$deliveryDetails || !$items) return [
            'error' => true,
            'message' => 'Unable to create order because of empty form fields.'
        ];

        if (!$costAndDistance) {
            $routeData = $this->getDistanceBetweenPostcodes([
                'from' => $deliveryDetails['pickUpPostCode'],
                'to' => $deliveryDetails['deliveryPostCode']
            ]);
            $costAndDistance = $this->generateCostAndDistance($deliveryDetails, $items, $routeData);
        }

        $order = new Order();
        $order->username = $userInfo['username'];
        $order->email = $userInfo['email'];
        $order->phone = $userInfo['phone'];
        $order->order_items = json_encode($items);
        $order->order_dateTime = now();
        $order->quote_fee = $costAndDistance['quote'];
        $order->upfront_fee = $costAndDistance['upfront'];
        $order->outstanding_fee  = $costAndDistance['quote'] - $costAndDistance['upfront'];
        $order->distance = $costAndDistance['distance_miles'] . ' miles';
        $order->duration = $costAndDistance['duration'] . ' min';
        $order->order_pickUpAddress = $deliveryDetails['pickUpAddress'];
        $order->order_pickUpCoordinates = json_encode($costAndDistance['fromCoord']);
        $order->order_pickUpPostCode = $deliveryDetails['pickUpPostCode'];
        $order->order_pickUpFloor = $deliveryDetails['pickUpFloor'];
        $order->order_pickUpNeedExtraMan = $deliveryDetails['packingAtPickUp'];
        $order->order_pickUpCanUseElevator = $deliveryDetails['elevatorIsAvailableAtPickUp'];
        $order->order_expectedPickUpDateTime = $deliveryDetails['pickUpDate'];
        $order->order_deliveryAddress = $deliveryDetails['deliveryAddress'];
        $order->order_dropOffCoordinates = json_encode($costAndDistance['toCoord']);
        $order->order_expectedDeliveryDateTime = $deliveryDetails['pickUpDate'];
        $order->order_dropOffFloor = $deliveryDetails['deliveryFloor'];
        $order->order_dropOffPostCode = $deliveryDetails['deliveryPostCode'];
        $order->order_dropOffNeedExtraMan = $deliveryDetails['unpackingAtDelivery'];
        $order->order_dropOffCanUseElevator = $deliveryDetails['elevatorIsAvailableAtDelivery'];
        $order->status = 'pending';
        $order->payment_status = 'unpaid';
        $order->save();

        foreach ($items as $item) {
            OrderItem::create([
                'order_id' =>  $order->id,
                'item_id' => $item['id'],
                'qty' => $item["qty"],
            ]);
        }

        return [
            'error' => false,
            'message' => 'Order created successfully',
            'order' => $order
        ];
    }


    public function buildWhatsAppMsg($order)
    {
        $stringItemsArr = [];
        foreach (json_decode($order->order_items, true) as $item) {
            $stringItemsArr[] = $item["qty"] !== null ? $item["qty"] . ' ' . $item["name"] : $item["name"];
        }

        $stringItems = join(', ', $stringItemsArr);

        $message = "Hello, My name is *{$order->username}*. I'm contacting you to request an instant quotation for transportation services.\n" .
            "*Reference Number: {$order->order_refNo}*.\n" .
            "\n" .
            "*Transportation items*\n" .
            "{$stringItems}\n" .
            "\n" .
            "*Pick-up details*\n" .
            "Pick-up address: {$order->order_pickUpAddress}\n" .
            "Post code: {$order->order_pickUpPostCode}\n" .
            "Floor: {$order->order_pickUpFloor}\n" .
            "Extra man needed at pick-up: " . ($order->order_pickUpNeedExtraMan ? 'Yes' : 'No') . "\n" .
            "Can Elevator be used: " . ($order->order_pickUpCanUseElevator ? 'Yes' : 'No') . "\n" .
            "Date and Time: " . date('M d, Y H:i', strtotime($order->order_expectedPickUpDateTime)) . "\n" .
            "\n" .
            "*Delivery details*\n" .
            "Delivery address: {$order->order_deliveryAddress}\n" .
            "Post code: {$order->order_dropOffPostCode}\n" .
            "Floor: {$order->order_dropOffFloor}\n" .
            "Extra man needed at delivery: " . ($order->order_dropOffNeedExtraMan ? 'Yes' : 'No') . "\n" .
            "Can Elevator be used: " . ($order->order_dropOffCanUseElevator ? 'Yes' : 'No') . "\n" .
            "Date and Time: " . date('M d, Y H:i', strtotime($order->order_expectedDeliveryDateTime)) . "\n" .
            "\n" .
            "*Contact details*\n" .
            "Phone: {$order->phone}\n" .
            "Email: {$order->email}";
        // Encode the message
        $encodedMessage = urlencode($message);
        // Construct the WhatsApp URL
        return config('app.socials.whatsapp') . "?text={$encodedMessage}";
    }

    public function createCheckOut($order)
    {
        $apikey = config('app.stripe_key');
        if (empty($apikey)) {
            Log::error('Stripe key not set.');
            return ['error' => true, 'message' => 'Stripe configuration error.'];
        }
        $customer_email = $order->email;
        $stripe = new \Stripe\StripeClient($apikey);
        $lineItems = [
            [
                'price_data' => [
                    'currency' => 'gbp',
                    'product_data' => [
                        'name' => 'Partial payment to reserve your booking',
                    ],
                    'unit_amount' => round($order->upfront_fee) * 100,
                ],
                'quantity' => 1
            ]
        ];

        $checkout_session = $stripe->checkout->sessions->create([
            'customer_email' => $customer_email,
            'customer_creation' => 'always',
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('quote.move', [], true) . '?status=cancelled',
        ]);

        $order->checkout_session_id = $checkout_session->id;
        $order->save();


        return $checkout_session->url;
    }

    public function completeCheckout(Request $request)
    {
        $sessonId = $request->get('session_id');

        try {
            $stripe = new \Stripe\StripeClient(config('app.stripe_key'));

            $session = $stripe->checkout->sessions->retrieve($sessonId);
            if (!$session) {
                throw new NotFoundHttpException;
            }
            if ($session->payment_status != 'unpaid') {
                $order = Order::where('checkout_session_id', $session->id)->first();
                if (!$order) {
                    throw new NotFoundHttpException;
                }

                if ($order && $order->payment_status == 'unpaid') {
                    $order->payment_status = 'paid';
                    $order->save();
                }

                $vat = $order->quote_fee * config('app.vat_fee');
                $amountLessVat = $order->quote_fee - $vat;
                $value = $this->getMoniAndCoin($amountLessVat);


                return inertia('General/CheckoutSuccess')->with([
                    'respData' => [
                        'refNo' => $order->order_refNo,
                        'username' => $order->username,
                        'email' => $order->email,
                        'value' => (float)$value,
                    ]
                ]);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new NotFoundHttpException;
        }
    }

    public function checkoutWebhook()
    {
        $stripe = new \Stripe\StripeClient(config('app.stripe_key'));
        $endpoint_secret = config('app.stripe_webhook_key');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('', 400);
        }

        // Handle the event
        if (
            $event->type == 'checkout.session.completed'
            || $event->type == 'checkout.session.async_payment_succeeded'
        ) {
            $session = $event->data->object;
            $sessionId = $session->id;
            $order = Order::where('checkout_session_id', $sessionId)->first();
            if ($order && $order->payment_status == 'unpaid') {
                $order->payment_status = 'paid';
                $order->save();
            }
            try {
                /* SEND USER EMAILS NOW */
                Mail::to($order->email)->send(new OrderPaidMail([
                    'quote' => $order->quote_fee,
                    'outstanding' => $order->outstanding_fee,
                    'upfront' => $order->upfront_fee,
                    'username' => $order->username,
                    'items' => $order->order_items,
                    'expectedDeliveryDateTime' => $order->order_expectedDeliveryDateTime,
                    'dropOffFloor' => $order->order_dropOffFloor,
                    'deliveryAddress' => $order->order_deliveryAddress,
                    'expectedPickUpDateTime' => $order->order_expectedPickUpDateTime,
                    'pickUpFloor' => $order->order_pickUpFloor,
                    'pickUpAddress' => $order->order_pickUpAddress,
                ]));
                /* SEND MAIL TO ORDER TEAM */
                Mail::to(config('mail.order_to.address'))->send(new AdminOrderPaid($order));
                session()->forget(['delivery_items_details', 'delivery_details', 'personalDetails']);
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }
        } elseif ($event->type = "checkout.session.async_payment_failed") {
            $session = $event->data->object;
            $order = Order::where('checkout_session_id', $session->id)->first();
            Mail::to($order->email)->send(new OrderPaymentFailed([
                'username' => $order->username,
                'upfront' => $order->upfront_fee,
                'refNo' => $order->order_refNo,
            ]));
        }

        return response('', 200);
    }
}
