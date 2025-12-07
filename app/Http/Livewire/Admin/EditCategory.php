<?php

namespace App\Http\Livewire\Admin;

use App\Models\Item;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditCategory extends Component
{
    //Use WithFileUploads;

    public $item;
    public $name='';
    public $description='';
    public $isCountable='';
    public $pricePerUnit = 0;
    //public $photo;

    public function mount(Item $item){
        $this->item = $item;
        $this->name = $item->name;
        $this->description = $item->description;
        $this->isCountable = $item->isCountable;
        $this->pricePerUnit = number_format($item->pricePerUnit);
    }

    protected $listeners = [
        'itemUpdated' => '$refresh',
    ];

    protected function rules(){
        return [
            'name' => 'required|string|max:225',
            'description'=>'required|string',
            'isCountable'=>'required|boolean',
            'pricePerUnit' => 'required|numeric',
            //'photo'=>[Rule::excludeIf(!$this->photo),'image','max:2000'],
        ];
    } 

    public function save(){
        $this->validate();

        try{
            $this->item->name = $this->name;
            $this->item->description = $this->description;
            $this->item->isCountable = $this->isCountable;
            $this->item->pricePerUnit = $this->pricePerUnit;
            /* if($this->photo){
                $this->item->photo_url = $this->photo->store('item_photos','public');
            }   */          
            if(auth()->guard('admin')->check()){
                $this->item->updatedByAdmin_id = auth()->guard('admin')->user()->id;
            }
            $this->item->save();
            $this->emit('itemUpdated');
        }catch(\Throwable $th){
            Log::error('Item updating failed: '.$th->getMessage());
            $this->emit('itemUpdateFailed');
        }
    }
    public function render()
    {
        return view('livewire.admin.edit-category');
    }
}
