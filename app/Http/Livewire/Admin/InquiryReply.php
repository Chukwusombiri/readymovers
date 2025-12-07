<?php

namespace App\Http\Livewire\Admin;

use App\Mail\InquiryReplyMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class InquiryReply extends Component
{   
    public $recipient = '';
    public $subject = '';
    public $body = '';
    protected function rules(){
        return [
            'recipient' => ['required','email:dns,rfc'],            
            'subject' => ['required','string'],
            'body' => ['required','string'],
        ]; 
    } 

    protected $validationAttributes = [
        'recipient' => 'Recipient email address'
    ];

    public function mount($sentRecipient){        
        $this->recipient=$sentRecipient;
    }

    public function sendEmail(){                
        $this->validate();
        try {
            $data = [
                'subject'=>$this->subject,
                'body'=>$this->body,
            ];            
            Mail::to($this->recipient)->send(new InquiryReplyMessage($data));
            session()->flash('success','Successful! Email message has been sent to recipient');
            $this->reset();
        } catch (\Throwable $th) {
            throw $th;
            Log::info('Unable to send email: '.$th->getMessage());
           $this->emit('actionFailed');
        }       
    }
    public function render()
    {
        return view('livewire.admin.inquiry-reply');
    }
}
