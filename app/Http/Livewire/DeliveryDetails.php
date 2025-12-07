<?php

namespace App\Http\Livewire;

use App\Models\Floor;
use App\Traits\HostBasedRedirect;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DeliveryDetails extends Component
{
    use HostBasedRedirect;
    public $pickUpAddress='';
    public $pickUpCoordinates='';
    public $pickUpFloor='';
    public $pickUpPostCode='';
    public $pickUpCanUseElevator=false;
    public $pickUpNeedExtraMan=false;
    public $dropOffAddress='';
    public $dropOffCoordinates='';
    public $dropOffFloor='';
    public $dropOffPostCode='';
    public $dropOffCanUseElevator=false;
    public $dropOffNeedExtraMan=false;
    public $pickSuggestions=[];
    public $dropSuggestions=[];
    public $floors='';
    public $pickUpDateTime='';
    public $latitude;
    public $longitude;
    public $loc;
    public $infoLat;
    public $infoLong;

    protected $rules = [
        'pickUpAddress' => ['required','string'],
        'pickUpCoordinates' => ['required','array'],
        'pickUpFloor' => ['required','string','exists:floors,name'],
        'pickUpPostCode' => ['required','regex:/^[A-Za-z0-9\- ]+$/'],
        'pickUpCanUseElevator'=>['boolean'],
        'pickUpNeedExtraMan'=>['boolean'],
        'dropOffAddress' => ['required','string'],
        'dropOffCoordinates' => ['required','array'],
        'dropOffFloor' => ['required','string','exists:floors,name'],
        'dropOffPostCode' => ['required','regex:/^[A-Za-z0-9\- ]+$/'],
        'pickUpDateTime'=>['required','date','after_or_equal:today'],
        'dropOffNeedExtraMan'=>['boolean'],
        'dropOffCanUseElevator'=>['boolean'],
    ];

    protected $listeners = ['setProximity'];

    public function setProximity($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    protected $validationAttributes = [
        'pickUpAddress' => 'Pick-up address',
        'pickUpFloor' => 'Pick-up floor',
        'pickUpPostCode' => 'Pick-up postal code',
        'dropOffAddress' => 'Drop-off address',
        'dropOffFloor' => 'Drop-off floor',
        'dropOffPostCode' => 'Drop-off postal code',
        'pickUpDateTime' => 'Pick-up date',
        'pickUpCanUseElevator' => 'Pick-up Elevator',
        'pickUpNeedExtraMan' => 'Pick-up Extra man',
        'dropOffNeedExtraMan' => 'Drop-off Extra man',
        'dropCanShouldUseElevator' => 'Drop-off Elevator',
    ];

    public function mount(){
        $this->floors = Floor::all();  
        $data = session()->get('delivery_details');
        if($data){
            $this->pickUpAddress = $data["pickUpAddress"];
            $this->pickUpCoordinates = $data["pickUpCoordinates"];
            $this->pickUpFloor = $data["pickUpFloor"];
            $this->pickUpPostCode = $data["pickUpPostCode"];
            $this->pickUpCanUseElevator = $data["pickUpCanUseElevator"];
            $this->pickUpNeedExtraMan = $data["pickUpNeedExtraMan"];
            $this->dropOffAddress = $data["dropOffAddress"];
            $this->dropOffCoordinates = $data["dropOffCoordinates"];
            $this->dropOffFloor = $data["dropOffFloor"];
            $this->dropOffPostCode = $data["dropOffPostCode"];
            $this->dropOffCanUseElevator = $data["dropOffCanUseElevator"];
            $this->dropOffNeedExtraMan = $data["dropOffNeedExtraMan"];
            $this->pickUpDateTime = $data["pickUpDateTime"];
        }

        $resp = Http::get('https://ipinfo.io?token='.config('services.ipinfo.access_token'));
        $jResp = $resp->json();
        [$infoLat, $infoLong] = explode(',', $jResp['loc']);
        $this->loc = $infoLong.",".$infoLat;
       
    }

    public function updatedPickUpAddress(){         
        $proximity = ($this->latitude && $this->longitude) ? "&proximity={$this->longitude},{$this->latitude}" : "&proximity={$this->loc}";

        $response = Http::get("https://api.mapbox.com/search/searchbox/v1/forward?q=" 
                              . urlencode($this->pickUpAddress) 
                              . "&language=en&limit=9&country=GB"
                              . $proximity
                              . "&access_token=" . config('app.mapbox_token'));

        $data = $response->json();
        // Check if the response is successful and contains features
        if ($response->successful() && isset($data['features'])) {
            // Extract suggestions from features
            $this->pickSuggestions = collect($data['features'])->map(function ($feature) {
                $location = $feature['properties'];
                $geometry = $feature['geometry']['coordinates'];
                return [
                    'address' => $location['full_address'] ?? $location['place_formatted'],
                    'coordinates' => $geometry,
                ];
            })->toArray();            
        } else {
            // Clear suggestions if no valid response is received
            $this->pickSuggestions = [];
        }        
    }

    public function updatedDropOffAddress(){
        $proximity = ($this->latitude && $this->longitude) ? "&proximity={$this->longitude},{$this->latitude}" : "&proximity={$this->loc}";

        $response = Http::get("https://api.mapbox.com/search/searchbox/v1/forward?q=" 
                              . urlencode($this->dropOffAddress) 
                              . "&language=en&limit=9&country=GB"
                              . $proximity
                              . "&access_token=" . config('app.mapbox_token'));
        $data = $response->json();
        // Check if the response is successful and contains features
        if ($response->successful() && isset($data['features'])) {
            // Extract suggestions from features
            $this->dropSuggestions = collect($data['features'])->map(function ($feature) {
                $location = $feature['properties'];
                $geometry = $feature['geometry']['coordinates'];
                return [
                    'address' => $location['full_address'] ?? $location['place_formatted'],
                    'coordinates' => $geometry,
                ];
            })->toArray();            
        } else {
            // Clear suggestions if no valid response is received
            $this->dropSuggestions = [];
        }        
    }

    public function setAddress($index,$field){
        if($field === 'pickUpAddress'){
            $this->pickUpAddress = $this->pickSuggestions[$index]["address"];
            $this->pickUpCoordinates = $this->pickSuggestions[$index]["coordinates"];
            $this->pickSuggestions = [];
        }elseif($field==='dropOffAddress'){
            $this->dropOffAddress = $this->dropSuggestions[$index]["address"];
            $this->dropOffCoordinates = $this->dropSuggestions[$index]["coordinates"];
            $this->dropSuggestions = [];
        }
    }

    public function previousStep(){
        return $this->redirectBasedOnHost();
    }      

    public function submitStep2(){
        $this->validate();
        if(session()->get('delivery_details')){
            session()->forget('delivery_details');
        }
        $elevator_fee = config('app.elevator_rate');
        $pickUpFloorFee = Floor::where('name','=',$this->pickUpFloor)->first();
        $dropOffFloorFee = Floor::where('name','=',$this->dropOffFloor)->first();        
        $pickUpfloor_fee = ($pickUpFloorFee->multiplier * config('app.floor_rate'));
        $dropOffFloor_fee = ($dropOffFloorFee->multiplier * config('app.floor_rate'));

        $pickAndDropFee = 0;
        if($this->pickUpCanUseElevator==true){
            $pickAndDropFee += $elevator_fee;
        }else{
            $pickAndDropFee += $pickUpfloor_fee;
        }

        if($this->dropOffCanUseElevator==true){
            $pickAndDropFee += $elevator_fee;
        }else{
            $pickAndDropFee += $dropOffFloor_fee;
        }
        
        try {
            session()->put('delivery_details', [
                'pickUpDateTime' => $this->pickUpDateTime,
                'pickUpPostCode' => $this->pickUpPostCode,
                'pickUpAddress' => $this->pickUpAddress,
                'pickUpCoordinates' => $this->pickUpCoordinates,
                'pickUpFloor' => $this->pickUpFloor,
                'pickUpNeedExtraMan' => $this->pickUpNeedExtraMan,
                'pickUpCanUseElevator' => $this->pickUpCanUseElevator, 
                'dropOffPostCode' => $this->dropOffPostCode,
                'dropOffAddress' => $this->dropOffAddress,
                'dropOffCoordinates' => $this->dropOffCoordinates,
                'dropOffFloor' => $this->dropOffFloor,
                'dropOffNeedExtraMan' => $this->dropOffNeedExtraMan,
                'dropOffCanUseElevator' => $this->dropOffCanUseElevator,
                'pickAndDropFee' => $pickAndDropFee
            ]);          
            return redirect()->route('personalDetails');
        } catch (\Throwable $th) {
            $this->emit('invalidOperation');
            return;
        }        
    }
    
    public function render()
    {
        return view('livewire.delivery-details');
    }
}
