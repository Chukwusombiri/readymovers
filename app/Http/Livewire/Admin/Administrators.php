<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin;
use Livewire\Component;
use Livewire\WithPagination;

class Administrators extends Component
{
    Use WithPagination;

    public $search = '';

    public function updatedSearch(){
        $this->resetPage();
    }

    public function clear(){
        $this->search = '';
        $this->resetPage();
    }

    public function delete($id){
        Admin::where('id',$id)->delete();
        $this->emit('deletedAdmin');
    }
    
    public function render()
    {
        $admins = Admin::where('name','like','%'.$this->search.'%')
                    ->orWhere('email','like','%'.$this->search.'%')
                    ->whereNotIn('id',[auth('admin')->user()->id])
                    ->orderByDesc('created_at')
                    ->paginate(10);
        return view('livewire.admin.administrators',[
            'admins' => $admins,
        ]);
    }
}
