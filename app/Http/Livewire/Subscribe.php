<?php

namespace App\Http\Livewire;

use App\Models\EmailSubscriber;
use Livewire\Component;

class Subscribe extends Component
{
    public $email;

    protected $rules = [
        'email' => 'required|email:rfc,dns|unique:email_subscribers',
    ];

    protected $validationAttributes = [
        'email' => 'E-mail adress'
    ];

    public function submit(){
        $validated = $this->validate();
        EmailSubscriber::create($validated);

        $this->emit('subscribed');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.subscribe');
    }
}
