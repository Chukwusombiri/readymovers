<?php

namespace App\Http\Livewire;

use App\Mail\ClientQuoteMail;
use App\Mail\QuoteMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Traits\ConvertToMoney;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class PersonalDetails extends Component
{
    use ConvertToMoney;
    public $username = '';
    public $email = '';
    public $phone = '';
    public $isSubDomain = false;

    protected $rules=[
        'username' => 'required|string|max:225',
        'email' =>'required|email',
        'phone'=>['required','regex:/^(\+[0-9] ?+|[0-9] ?+){6,14}[0-9]$/'],
    ];

    protected $validationAttributes=[
        'username' => 'Full name'
    ];

    public function mount(){
        $this->isSubDomain = Str::startsWith(request()->getHost(), 'moves.');
        $data = session()->get('personalDetails');
        $this->username = $data['username'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->phone = $data['phone'] ?? '';
    }

    public function updated($property){
        $this->validateOnly($property);
    }

    public function previousStep()
    {        
        return redirect()->route('deliveryDetails');
    }

    public function submitStep3($redirect){
        $this->validate();
        $deliverydetails = session()->get('delivery_details');
        $deliveryitemsdetails = session()->get('delivery_items_details');                
        $orderItems = [];
              
        $pickUpLat = $deliverydetails['pickUpCoordinates'][0];
        $pickUpLong = $deliverydetails['pickUpCoordinates'][1];
        $dropOffLat = $deliverydetails['dropOffCoordinates'][0];
        $dropOffLong = $deliverydetails['dropOffCoordinates'][1];

        $response = Http::get('https://api.mapbox.com/directions/v5/mapbox/driving/'.$pickUpLat.','.$pickUpLong.';'.$dropOffLat.','.$dropOffLong.'?geometries=geojson&access_token='.config('app.mapbox_token'));
        $data = $response->json();
        $distance = $data["routes"][0]["distance"];        
        $duration = $data["routes"][0]["duration"];  
        
        $item_fees = 0;
        foreach ($deliveryitemsdetails as $key => $value) {
            $fees= $value["qty"]!==null ? $value["qty"] * $value["pricePerUnit"] : $value["pricePerUnit"];
            $item_fees += $fees;
        }
              
        $next_tot_fee = (($distance*0.000621371)*config('app.rating')) + $item_fees + $deliverydetails["pickAndDropFee"];
        $tot_fee = $next_tot_fee + ($next_tot_fee * config('app.vat_fee'));
        $quote_fee = $tot_fee!==floor($tot_fee) ? $this->getMoniAndCoin($tot_fee) : $tot_fee; 
        $upfront = $tot_fee * config('app.upfront');
        $upfront_fee = $upfront!==floor($upfront) ? $this->getMoniAndCoin($upfront) : $upfront; 
        
        /* new order */
        $order = new Order();                
        $order->username = $this->username;
        $order->email = $this->email;
        $order->phone = $this->phone;        
        $order->order_items = json_encode($orderItems);
        $order->order_dateTime = now();
        $order->quote_fee = $quote_fee;
        $order->upfront_fee = $upfront_fee;
        $order->outstanding_fee  = $quote_fee - $upfront_fee;
        $order->distance = $distance*0.000621371.' miles';
        $order->duration = round($duration/60).' min';
        $order->order_pickUpAddress = $deliverydetails['pickUpAddress'];
        $order->order_pickUpCoordinates = json_encode($deliverydetails["pickUpCoordinates"]);
        $order->order_pickUpPostCode = $deliverydetails['pickUpPostCode'];
        $order->order_pickUpFloor = $deliverydetails['pickUpFloor'];
        $order->order_pickUpNeedExtraMan = $deliverydetails['pickUpNeedExtraMan'];
        $order->order_pickUpCanUseElevator = $deliverydetails['pickUpCanUseElevator'];
        $order->order_expectedPickUpDateTime = $deliverydetails['pickUpDateTime'];
        $order->order_deliveryAddress = $deliverydetails['dropOffAddress'];
        $order->order_dropOffCoordinates = json_encode($deliverydetails["dropOffCoordinates"]);
        $order->order_expectedDeliveryDateTime = Carbon::now();
        $order->order_dropOffFloor = $deliverydetails['dropOffFloor'];
        $order->order_dropOffPostCode = $deliverydetails['dropOffPostCode'];
        $order->order_dropOffNeedExtraMan = $deliverydetails['dropOffNeedExtraMan'];
        $order->order_dropOffCanUseElevator = $deliverydetails['dropOffCanUseElevator'];
        $order->status = 'pending';
        $order->payment_status = 'unpaid';
        $order->save();
        foreach ($deliveryitemsdetails as $key => $item) {
            OrderItem::create([
                'order_id' =>  $order->id,
                'item_id' => $key,
                'qty' => $item["qty"],
            ]);
            /* make a string from merging qty and item name, then push into orderItems */
            $orderItems[] = $item["qty"]!==null ? $item["qty"].' '.$item["name"] : $item["name"];
        }
        $order->order_items = json_encode($orderItems);
        $order->save();
        $stringItems = implode(", ", $orderItems);        
        // Construct the message
        if($redirect==='whatsapp'){
            $message = "Hello, My name is *{$this->username}*. I'm contacting you to request an instant quotation for transportation services.\n".
            "*Reference Number: {$order->order_refNo}*.\n".
            "\n".
            "*Transportation items*\n".
           "{$stringItems}\n".
           "\n".
           "*Pick-up details*\n".
           "Pick-up address: {$order->order_pickUpAddress}\n".
           "Post code: {$order->order_pickUpPostCode}\n".
           "Floor: {$order->order_pickUpFloor}\n".
           "Extra man needed: ".($order->order_pickUpNeedExtraMan ? 'Yes' : 'No')."\n".
           "Can Elevator be used: ".($order->order_pickUpCanUseElevator ? 'Yes' : 'No')."\n".
           "Date and Time: ".date('M d, Y H:i', strtotime($order->order_expectedPickUpDateTime))."\n".
           "\n".
           "*Delivery details*\n".
           "Delivery address: {$order->order_deliveryAddress}\n".
           "Post code: {$order->order_dropOffPostCode}\n".
           "Floor: {$order->order_dropOffFloor}\n".
           "Extra man needed: ".($order->order_dropOffNeedExtraMan ? 'Yes' : 'No')."\n".
           "Can Elevator be used: ".($order->order_dropOffCanUseElevator ? 'Yes' : 'No')."\n".
           "Date and Time: ".date('M d, Y H:i', strtotime($order->order_expectedDeliveryDateTime))."\n".
           "\n".
           "*Contact details*\n".
           "Phone: {$order->phone}\n".
           "Email: {$order->email}";        
            // Encode the message
            $encodedMessage = urlencode($message);    
            // Construct the WhatsApp URL
            $whatsappUrl = "https://wa.me/+447498059712?text={$encodedMessage}";   
            // Remove session data for the "delivery_details" key
            session()->forget('delivery_details');
            // Remove session data for the "delivery_items_details" key
            session()->forget('delivery_items_details');        
             
             /* return redirect()->away($whatsappUrl); */
            $this->reset();
            return redirect()->away($whatsappUrl);
        }elseif($redirect==='email'){
            try {
                Mail::to($order->email)->send(new ClientQuoteMail(['client'=>$order->username,'dropOffAddress'=>$order->order_deliveryAddress,'pickUpAddress'=>$order->order_pickUpAddress,]));
                Mail::to(config('mail.from.address'))->send(new QuoteMail($order));
                $this->dispatchBrowserEvent('sentOrderMail');
                $this->reset();
                session()->forget(['delivery_details','delivery_items_details']);
                return;               
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('OrderMailFailed');
                Log::error($th->getMessage());
                return;
            }            
        }                      
    } 

    public function instantQuote(){
        $this->validate();
        $deliverydetails = session()->get('delivery_details');
        $deliveryitemsdetails = session()->get('delivery_items_details');
        $mileRate = config('app.rating');

        $pickUpLat = $deliverydetails['pickUpCoordinates'][0];
        $pickUpLong = $deliverydetails['pickUpCoordinates'][1];
        $dropOffLat = $deliverydetails['dropOffCoordinates'][0];
        $dropOffLong = $deliverydetails['dropOffCoordinates'][1];

        $response = Http::get('https://api.mapbox.com/directions/v5/mapbox/driving/'.$pickUpLat.','.$pickUpLong.';'.$dropOffLat.','.$dropOffLong.'?geometries=geojson&access_token='.config('app.mapbox_token'));
        $data = $response->json();
        $distance = $data["routes"][0]["distance"];            
        $duration = $data["routes"][0]["duration"];             
        $geometry = $data["routes"][0]["geometry"]['coordinates'];    
        
        $item_fees = 0;

        foreach ($deliveryitemsdetails as $key => $value) {
            $fees= $value["qty"]!==null ? $value["qty"] * $value["pricePerUnit"] : $value["pricePerUnit"];
            $item_fees += $fees;
        }
        $fees = (($distance*0.000621371)*$mileRate) + $item_fees + $deliverydetails["pickAndDropFee"];
        $quote = $fees + ($fees * config('app.vat_fee'));
        $upfront = ($quote) * config('app.upfront');
        $miles = $distance/1609.35;        
        $time = $duration/60;

        if(session()->has('personalDetails')){
            session()->forget('personalDetails');            
        }        

        session()->put('personalDetails',[
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,   
            'quote' => $quote,
            'upfront' => $upfront,
            'miles' => $miles,
            'time' => $time,
            'geometry'=>$geometry,
        ]);

        return redirect()->route('showQuote');
    }    
    
    public function render(){
        return view('livewire.personal-details');
    }
}
