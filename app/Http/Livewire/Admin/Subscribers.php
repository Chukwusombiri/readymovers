<?php

namespace App\Http\Livewire\Admin;

use App\Models\EmailSubscriber;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class Subscribers extends Component
{
    Use WithPagination;
    public $search = '';
    public $recipients = [];

    public function updatedSearch(){
        $this->resetPage();
    }

    public function clear(){
        $this->search = '';
        $this->resetPage();
    }

    public function delete(EmailSubscriber $subcriber){
        try{
            $subcriber->delete();
            $this->emit('subcriberDeleted');
        }catch(\Throwable $th){
            dd($th);
            $this->emit('failedDeletion');
        }
    }

    public function sendToMany(){
        if(count($this->recipients)>0){
            $validator = Validator::make([
                'recipients' => $this->recipients
            ],[
                'recipients'=>'required|array',
                'recipients.*'=>'required|email:dns,rfc',
             ],[
                'recipients.*.required' => 'Selected emails must be a valid email address',
                'recipients.*.email' => 'Selected emails must be a valid email address',
             ]);

             if($validator->fails()){
                session()->flash('error','select valid emails addresses');
                return;
             }

             return redirect()->route('subscriber.email',['email'=>json_encode($this->recipients)]);
        }else{
            return redirect()->route('subscriber.email');
        }       
    }
    public function render()
    {
        $subcribers = EmailSubscriber::where('email','like','%'.$this->search.'%')->paginate(10);
        return view('livewire.admin.subscribers',[
            'subscribers' => $subcribers,
        ]);
    }
}
