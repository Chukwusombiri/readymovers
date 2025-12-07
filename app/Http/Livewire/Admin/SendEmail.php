<?php

namespace App\Http\Livewire\Admin;

use App\Mail\SendEmailMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Livewire\Component;

class SendEmail extends Component
{
    public $recipients = [];
    public $newRecipient = '';
    public $subject = '';
    public $body = '';
    public $bulkEmail = false;
    protected function rules(){
        return [
            'recipients' => ['required','array'],
            'recipients.*' => ['required','email:dns,rfc'],
            'newRecipient' => [Rule::excludeIf($this->newRecipient === ''),'email:dns,rfc',Rule::notIn($this->recipients),],
            'subject' => ['required','string'],
            'body' => ['required','string'],
        ]; 
    } 

    protected $validationAttributes = [
        'newRecipient' => 'New recipient',
        'recipients.*' => 'Recipient email address'
    ];

    public function mount($sentRecipients){        
        if(is_array($sentRecipients)){
            foreach ($sentRecipients as $value) {
                $this->recipients[]=$value;
            }
        }

        if(session()->get('isBulk')){
            $this->bulkEmail = true;
        }
    }    

    public function addRecipient(){
        $this->validate([
            'newRecipient' => ['required','email:dns,rfc',Rule::notIn($this->recipients),],
        ]);
        $this->recipients[] = $this->newRecipient;
        $this->newRecipient = '';    
        if($this->bulkEmail==true){
            session()->flash('success','Added new recipient email address');
        }
    }

    public function removeRecipient($index){
        unset($this->recipients[$index]);
    }

    public function sendEmail(){        
        $this->validate();
        try {
            $data = [
                'subject'=>$this->subject,
                'body'=>$this->body,
            ];
            foreach ($this->recipients as $key => $value) {
                Mail::to($value)->send(new SendEmailMessage($data));
            }
            session()->flash('success','Successful! Email message has been sent to recipient'.count($this->recipients)>1 ?'s' : '');            
            if(session()->has('isBulk')){
                session()->forget('isBulk');
            }
            $this->reset();
        } catch (\Throwable $th) {
            throw $th;
            Log::info('Unable to send email: '.$th->getMessage());
           $this->emit('actionFailed');
        }       
    }
        
    public function render()
    {       
        return view('livewire.admin.send-email');
    }
}
