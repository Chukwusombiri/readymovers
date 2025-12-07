<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;

class DeliveryItemsDetails extends Component
{
    public $selectedItem;
    public $inputItems = [];   
    public $allItems; 

    protected $rules = [        
        'inputItems'=>'required|array',
        'inputItems.*'=>'required|array',
    ];

    protected $validationAttributes = [
        'inputItems'=>'Items'
    ];

    public function mount($sentItem=null){
        $this->selectedItem = Item::find($sentItem);        
        $this->allItems = Item::all();     
        $data = session()->get('delivery_items_details');

        if ($data) {            
            $this->inputItems = $data;
        }elseif($this->selectedItem && $this->selectedItem->exists()){
            $element = $this->selectedItem;
            $this->inputItems["$element->id"] = [
                "name" => $element->name,
                "qty" => $element->isCountable ? 1 : null,
                "pricePerUnit" => $element->pricePerUnit,
            ];
        }
    }

    public function removeItem(Item $element){
        try {
            unset($this->inputItems["$element->id"]);
        } catch (\Throwable $th) {
            session()->flash('error','Oops! something\'s wrong, refresh page and try again');
        }
    }

    public function tryValue(Item $element){              
        if($element && $element->exists()){            
            if (in_array($element->id, array_keys($this->inputItems))) {
                // Remove item from the array
                unset($this->inputItems["$element->id"]);
            } else {
                // Add item to the array
                $this->inputItems[$element->id]=[
                    "name" => $element->name,
                    "qty" => $element->isCountable ? 1 : null,
                    "pricePerUnit" => $element->pricePerUnit,
                ];
            }          
        }else{
            $this->emitUp('invalidOperation');
        }      
    }

    public function incrementQty(Item $element){
        try{
            $this->inputItems["$element->id"]["qty"]++;            
        }catch(\Throwable $th){           
            session()->flash('error','Oops! Something went wrong refresh page and try again');
            return;
        }
    }

    public function reduceQty(Item $element){
        try{
            if ($this->inputItems["$element->id"]["qty"] == 1) {
                throw new \Exception('Quantity cannot be negative');
            }
            $this->inputItems["$element->id"]["qty"]--;
        }catch(\Throwable $th){
            session()->flash('error','Oops! Something went wrong refresh page and try again');
        }
    }

    public function storeData(){        
        try {         
            // Query the database to check if any items match the IDs in $inputItems
            $matchingItems = Item::whereIn('id', array_keys($this->inputItems))->get();

            // Check if the count of matching items is equal to the count of $inputItems
            if ($matchingItems->count() !== count(array_keys($this->inputItems))) {
                throw new \Exception('uncorresponding item models in input items array');
            }   
            session()->put('delivery_items_details',$this->inputItems );            
        } catch (\Throwable $th) {
            $this->emit('invalidOperation');
            return;
        }        
    }

    public function submitStep1(){
        $this->validate();
        $data = session()->get('delivery_items_details');
        if ($data) {
            session()->forget('delivery_items_details');
        }
        try {
            $this->storeData();
            $this->reset();           
            return redirect()->route('deliveryDetails');
        } catch (\Throwable $th) {
            dd($th);
            $this->emit('invalidOperation');
            return;
        }        
    }

    public function render(){
        return view('livewire.delivery-items-details');
    }
}
