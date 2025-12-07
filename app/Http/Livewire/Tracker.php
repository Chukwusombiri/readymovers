<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class Tracker extends Component
{
    public $refNo;

    protected $rules = [
        'refNo' => ['required',/* 'exists:orders,order_refNo' */]
    ];

    protected $validationAttributes = [
        'refNo' => 'Order Reference number'
    ];

    public function submit(){
        $this->validate();

        // data returned by user input
        $order = Order::where('order_refNo',$this->refNo)->first(); 

        // Construct the message
        $message = "Hello, My name is {$order->username}. I'm contacting you about my items transport with order REFNO: {$order->order_refNo}";
        
        // Encode the message
        $encodedMessage = urlencode($message);

        // Construct the WhatsApp URL
        $whatsappUrl = "https://wa.me/+2348125843137?text={$encodedMessage}";

        /* reset input field */
        $this->reset();

        // Redirect the user
        return redirect()->away($whatsappUrl);
    }


    public function render()
    {
        return view('livewire.tracker');
    }
}
