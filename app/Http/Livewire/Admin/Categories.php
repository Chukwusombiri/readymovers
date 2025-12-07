<?php

namespace App\Http\Livewire\Admin;

use App\Models\Item;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Categories extends Component
{
    public $allItems;

    protected $listeners = [
        'itemDeleted' => '$refresh',
    ];
    public function mount(){
        $this->allItems = Item::orderByDesc('created_at')->get();       
    }

    public function deleteItem(Item $item){
        try {
            $item->delete();
            $this->emit('itemDeleted');
        } catch (\Throwable $th) {
            Log::error('Error deleting item: ' . $th->getMessage());
            $this->emit('deleteFailed');
        }
    }

    public function render()
    {
        return view('livewire.admin.categories');
    }
}
