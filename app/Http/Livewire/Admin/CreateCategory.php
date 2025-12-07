<?php

namespace App\Http\Livewire\Admin;

use App\Models\Item;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateCategory extends Component
{
    //Use WithFileUploads;
    
    public $name='';
    public $description='';
    public $isCountable='';
    public $pricePerUnit = 0;
    //public $photo;    

    protected function rules(){
        return [
            'name' => 'required|string|max:225',
            'description'=>'required|string',
            'isCountable'=>'required|boolean',
            'pricePerUnit' => 'required|numeric|min:1',
            //'photo'=>['required','image','max:2000'],
        ];
    } 

    public function save(){
        $this->validate();

        try{
            $item = new Item();
            $item->name = $this->name;
            $item->description = $this->description;
            $item->isCountable = $this->isCountable;
            $item->pricePerUnit = $this->pricePerUnit;
            $item->photo_url = /* $this->photo->store('item_photos','public') */ 'items_photos/photo_placeholder.jpg';     
            if(auth()->guard('admin')->check()){
                $item->createdByAdmin_id = auth()->guard('admin')->user()->id;
            }
            $item->save();
            $this->emit('itemCreated');
            $this->reset();
        }catch(\Throwable $th){
            Log::error('Item creating failed: '.$th->getMessage());
            $this->emit('itemCreateFailed');
        }
    }

    public function render()
    {
        return view('livewire.admin.create-category');
    }
}
