<?php

namespace App\Http\Livewire\Admin;

use App\Models\Inquiry;
use Livewire\Component;
use Livewire\WithPagination;

class Inquiries extends Component
{
    Use WithPagination;

    public $filters = ['show all','show read','show unread'];
    public $selectedFilter = 'show all';
    protected $listeners = [
        'markedRead' => '$refresh',
    ];
    

    public function markRead(Inquiry $inquiry){
        try {
            $inquiry->read_at = now();
            $inquiry->save();
            $this->emit('markedRead');
        } catch (\Throwable $th) {
            $this->emit('failedAction',[
                'action' => 'MARK AS READ'
            ]);
        }
    }

    public function delete(Inquiry $inquiry){
        try {
            $inquiry->delete();
            $this->emit('deletedInquiry');
        } catch (\Throwable $th) {
            throw $th;
            $this->emit('failedAction',[
                'action' => "DELETE INQUIRY"
            ]);
        }
    }

    public function applyFilter($value){
        if(in_array($value,$this->filters)){
            $this->selectedFilter = $value;
            $this->resetPage();
        }
    }
    public function render()
    {
        $inquiries ='';
        switch($this->selectedFilter){
            case 'show all':
                $inquiries = Inquiry::orderByDesc('created_at')->paginate(5);
                break;
            case 'show read':
                $inquiries = Inquiry::where('read_at','!=',null)->orderByDesc('created_at')->paginate(5);
                break;
            case 'show unread':
                $inquiries = Inquiry::where('read_at','==',null)->orderByDesc('created_at')->paginate(5);
                break;
            default:
                $inquiries = Inquiry::orderByDesc('created_at')->paginate(5);
                break;
        }
        
        return view('livewire.admin.inquiries',[
            'inquiries' => $inquiries,
        ]);
    }
}
