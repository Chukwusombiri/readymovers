<?php

namespace App\Http\Livewire\Admin;

use App\Models\Floor;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Traits\ConvertToMoney;

class OrderDetails extends Component
{
    use ConvertToMoney;

    public $order;
    public $showStatus = false;
    public $quoteFee = '';
    public $username = '';
    public $phone = '';
    public $email = '';
    public $order_dateTime = '';
    public $orderItems = [];
    public $allItems;
    public $selectedItem = '';
    public $selectedItemQty = '';
    public $pickUpAddress = '';
    public $pickUpPostCode = '';
    public $pickUpFloor = '';
    public $expectedPickUpDateTime = '';
    public $actualPickUpDateTime = '';
    public $pickUpNeedExtraMan = '';
    public $pickUpCanUseElevator = '';
    public $dropOffAddress = '';
    public $dropOffPostCode = '';
    public $dropOffFloor = '';
    public $expectedDropOffDateTime = '';
    public $actualDropOffDateTime = '';
    public $dropOffNeedExtraMan = '';
    public $dropOffCanUseElevator = '';
    public $floors;

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->quoteFee = $order->quote_fee;
        $this->username  = $order->username;
        $this->phone = $order->phone;
        $this->email =  $order->email;
        $this->order_dateTime = $order->order_dateTime;
        $this->allItems = Item::all();        
        $data = OrderItem::with('item')->where('order_id', $order->id)->get();
        if ($data) {
            foreach ($data as $value) {
                $this->orderItems["$value->item_id"] = [
                    'name' => $value->item->name,
                    'qty' => $value->qty,
                ];
            }
        }
        $this->floors = Floor::all();
        $this->pickUpAddress = $order->order_pickUpAddress;
        $this->pickUpPostCode = $order->order_pickUpPostCode;
        $this->pickUpFloor = $order->order_pickUpFloor;
        $this->expectedPickUpDateTime = $order->order_expectedPickUpDateTime;
        $this->actualPickUpDateTime = $order->order_pickUpDateTime ?? '';
        $this->pickUpNeedExtraMan = $order->order_pickUpNeedExtraMan;
        $this->pickUpCanUseElevator = $order->order_pickUpCanUseElevator; 
        $this->dropOffAddress = $order->order_deliveryAddress;
        $this->dropOffPostCode = $order->order_dropOffPostCode;
        $this->dropOffFloor = $order->order_dropOffFloor;
        $this->expectedDropOffDateTime = $order->order_expectedDeliveryDateTime;
        $this->actualDropOffDateTime = $order->order_deliveryDateTime ?? '';
        $this->dropOffNeedExtraMan = $order->order_dropOffNeedExtraMan;
        $this->dropOffCanUseElevator = $order->order_dropOffCanUseElevator; 
    }

    protected $listeners = [
        'savedOrderItems' => '$refresh',
        'savedPickUpDetails' => '$refresh',
        'savedDropOffDetails' => '$refresh',
    ];

    protected $rules = [
        'quoteFee' => ['required', 'numeric',],
        'username' => ['required', 'string'],
        'phone' => ['required', 'regex:/^(\+[0-9] ?+|[0-9] ?+){6,14}[0-9]$/'],
        'email' => ['required', 'email:dns,rfc'],
        'order_dateTime' => ['required', 'date'],
        'orderItems' => ['required', 'array'],
        'orderItems.*' => ['required', 'array'],
        'selectedItem' => ['required', 'exists:items,id'],
        'selectedItemQty' => ['required', 'integer'],
    ];

    protected $validationAttributes = [
        'quoteFee' => 'Quote fee',
        'order_dateTime' => 'Order Date and Time',
        'selectedItem' => 'Selected item',
        'selectedItemQty' => 'Quantity',
        'pickUpAddress' => 'Pick-up address',
        'pickUpFloor' => 'Pick-up floor',
        'pickUpPostCode' => 'Pick-up postal code',
        'pickUpCanUseElevator' => 'Pick-up elevator',
        'pickUpNeedExtraMan' => 'Pick-up extra man',
        'expectedPickUpDateTime' => 'Expected Pick-up date and time',
        'actualPickUpDateTime' => 'Actual pick-up date and time',
        'dropOffAddress' => 'Delivery address',
        'dropOffFloor' => 'Delivery floor',
        'dropOffPostCode' => 'Delivery postal code',
        'dropOffCanUseElevator' => 'Delivery elevator',
        'dropOffNeedExtraMan' => 'Delivery extra man',
        'expectedDropOffDateTime' => 'Expected delivery date and time',
        'actualDropOffDateTime' => 'Actual delivery date and time',
    ];

    public function updatedQuoteFee($value)
    {
        $this->validateOnly($value);
    }

    public function updated($value)
    {
        $this->validateOnly($value);
    }

    public function saveQuoteFee()
    {
        $this->order->quote_fee = $this->quoteFee;
        $upfront = $this->quoteFee * config('app.upfront');
        $this->order->upfront_fee = $upfront!==floor($upfront) ? $this->getMoniAndCoin($upfront) : $upfront;
        $this->order->save();
        $this->emit('updatedQuote');
    }


    public function saveUserDetails()
    {
        $this->validate([
            'username' => 'required|string|max:225',
            'email' => 'required|email:dns,rfc',
            'phone' => ['required', 'regex:/^(\+[0-9] ?+|[0-9] ?+){6,14}[0-9]$/'],
            'order_dateTime' => 'required|date',
        ]);

        $this->order->username = $this->username;
        $this->order->email = $this->email;
        $this->order->phone = $this->phone;
        $this->order->order_dateTime = $this->order_dateTime;
        $this->order->save();
        $this->emit('userDetailsSaved');
    }

    public function removeItem(Item $element)
    {
        try {
            unset($this->orderItems["$element->id"]);
        } catch (\Throwable $th) {
            $this->emit('somethingWrong');
            return;
        }
    }

    public function incrementQty(Item $element)
    {
        try {
            $this->orderItems["$element->id"]["qty"]++;
        } catch (\Throwable $th) {
            $this->emit('somethingWrong');
            return;
        }
    }

    public function reduceQty(Item $element)
    {
        try {
            if ($this->orderItems["$element->id"]["qty"] == 1) {
                throw new \Exception('Quantity cannot be negative');
            }
            $this->orderItems["$element->id"]["qty"]--;
        } catch (\Throwable $th) {
            $this->emit('somethingWrong');
            return;
        }
    }

    public function saveOrderItems()
    {
        $this->validate([
            'orderItems' => ['required', 'array'],
            'orderItems.*' => ['required', 'array'],
            'selectedItem' => ['exists:items,id'],
            'selectedItemQty' => ['integer'],
        ]);

        $element = Item::find($this->selectedItem);
        if ($element && $element->exists()) {
            if (!in_array($element->id, array_keys($this->orderItems))) {
                $this->orderItems[$element->id] = [
                    "name" => $element->name,
                    "qty" => $element->isCountable ? $this->selectedItemQty : null,
                ];
            }
        }
        try {
            OrderItem::where('order_id', $this->order->id)->delete();
            $newOrderItems = [];
            foreach ($this->orderItems as $key => $item) {
                OrderItem::create([
                    'order_id' =>  $this->order->id,
                    'item_id' => $key,
                    'qty' => $item["qty"],
                ]);
                /* make a string from merging qty and item name, then push into orderItems */
                $newOrderItems[] = $item["qty"] !== null ? $item["qty"] . ' ' . $item["name"] : $item["name"];
            }
            $this->order->order_items = json_encode($newOrderItems);
            $this->order->save();
            $this->emit('savedOrderItems');
            $this->selectedItem = '';
            $this->selectedItemQty = '';
            return;
        } catch (\Throwable $th) {
            $this->emit('somethingWrong');
            return;
        }
    }

    public function savePickUpDetails(){
        $this->validate([
            'pickUpAddress' => ['required','string'],
            'pickUpFloor' => ['required','string','exists:floors,name'],
            'pickUpPostCode' => ['required','regex:/^[A-Za-z0-9\- ]+$/'],
            'pickUpCanUseElevator'=>['required','boolean'],
            'pickUpNeedExtraMan'=>['required','boolean'],
            'expectedPickUpDateTime'=>['required','date'],
            'actualPickUpDateTime'=>['date'],
        ],[

        ]);

        try {
            $this->order->order_pickUpAddress = $this->pickUpAddress;
            $this->order->order_pickUpPostCode = $this->pickUpPostCode;
            $this->order->order_pickUpFloor = $this->pickUpFloor;
            $this->order->order_pickUpCanUseElevator = $this->pickUpCanUseElevator;
            $this->order->order_pickUpNeedExtraMan = $this->pickUpNeedExtraMan;
            $this->order->order_expectedPickUpDateTime = $this->expectedPickUpDateTime;
            $this->order->order_pickUpDateTime = ($this->actualPickUpDateTime !== '') ? $this->actualPickUpDateTime : null;
            $this->order->save();
            $this->emit('savedPickUpDetails');
        } catch (\Throwable $th) {
            $this->emit('somethingWrong');
            return;
        }
    }

    public function saveDropOffDetails(){
        $this->validate([
            'dropOffAddress' => ['required','string'],
            'dropOffFloor' => ['required','string','exists:floors,name'],
            'dropOffPostCode' => ['required','regex:/^[A-Za-z0-9\- ]+$/'],
            'dropOffCanUseElevator'=>['required','boolean'],
            'dropOffNeedExtraMan'=>['required','boolean'],
            'expectedDropOffDateTime'=>['required','date'],
            'actualDropOffDateTime'=>['date'],
        ],[

        ]);

        try {
            $this->order->order_deliveryAddress = $this->dropOffAddress;
            $this->order->order_dropOffPostCode = $this->dropOffPostCode;
            $this->order->order_dropOffFloor = $this->dropOffFloor;
            $this->order->order_dropOffCanUseElevator = $this->dropOffCanUseElevator;
            $this->order->order_dropOffNeedExtraMan = $this->dropOffNeedExtraMan;
            $this->order->order_expectedDeliveryDateTime = $this->expectedDropOffDateTime;
            $this->order->order_deliveryDateTime = ($this->actualDropOffDateTime !== '') ? $this->actualDropOffDateTime : null;
            $this->order->save();
            $this->emit('savedDropOffDetails');
        } catch (\Throwable $th) {
            $this->emit('somethingWrong');
            return;
        }
    }

    public function toggleShowStatus()
    {
        $this->showStatus = !$this->showStatus;
    }

    public function setStatus($value)
    {
        if ($value === 'pending' || $value === 'approved' || $value === 'dispatched' || $value === 'delivered') {
            $this->order->status = $value;
            if(auth()->guard('admin')->check()){
                switch ($value) {
                    case 'pending':
                        $this->order->approvedByAdmin_id = null;
                        $this->order->approved_at = null;
                        $this->order->dispatchedByAdmin_id = null;
                        $this->order->dispatched_at - null;
                        $this->order->deliveredByAdmin_id = null;
                        $this->order->delivered_at = null;
                        break;
                    case 'approved':
                        $this->order->approvedByAdmin_id = auth('admin')->user()->id;
                        $this->order->approved_at = now();
                        $this->order->dispatchedByAdmin_id = null;
                        $this->order->dispatched_at - null;
                        $this->order->deliveredByAdmin_id = null;
                        $this->order->delivered_at = null;
                        break;
                    case 'dispatched':                        
                        $this->order->dispatchedByAdmin_id = auth('admin')->user()->id;
                        $this->order->dispatched_at = now();
                        $this->order->deliveredByAdmin_id = null;
                        $this->order->delivered_at = null;
                        break;
                    case 'delivered':
                        $this->order->deliveredByAdmin_id = auth('admin')->user()->id;
                        $this->order->delivered_at = now();
                        break;
                }
            }
            $this->order->save();
            $this->showStatus = false;
            $this->emit('statusUpdated');
        } else {
            $this->showStatus = false;
            $this->emit('statusUpdateFailed');
        }
    }

    public function setPaymentStatus($paymentStatus){
        try {
            $this->order->payment_status = $paymentStatus;
            $this->order->save();
            $this->emit('statusUpdated');
        } catch (\Throwable $th) {
            throw $th;
            Log::error($th->getMessage());
            $this->emit('statusUpdateFailed');
        }
    }
    public function render()
    {
        return view('livewire.admin.order-details');
    }

     /**
     * Get the formatted payment status color
     */
    public function getPaymentStatusColor($status)
    {
        $colors = [
            'paid' => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300',
            'refunded' => 'bg-neutral-100 dark:bg-neutral-900/30 text-neutral-800 dark:text-neutral-300',
            'pending' => 'bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300',
            'failed' => 'bg-rose-100 dark:bg-rose-900/30 text-rose-800 dark:text-rose-300'
        ];

        return $colors[$status] ?? 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-300';
    }

    /**
     * Get the formatted order status color
     */
    public function getOrderStatusColor($status)
    {
        $colors = [
            'pending' => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300',
            'approved' => 'bg-sky-100 dark:bg-sky-900/30 text-sky-800 dark:text-sky-300',
            'dispatched' => 'bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-300',
            'delivered' => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300',
            'cancelled' => 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300'
        ];

        return $colors[$status] ?? 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-300';
    }

}
