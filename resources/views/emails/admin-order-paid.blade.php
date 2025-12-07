<x-mail::message>
# Invoice paid for Booking {{$order->order_refNo}}

There's been a successful invoice payment of £{{$order->quote_fee}}. Outstanding payment for this invoice upon completion of services is £{{$order->outstanding_fee}}. 

## Invoice Reference No: {{$order->order_refNo}}

## Transport items
{{implode(", ",json_decode($order->order_items))}}

## Pick-up Information
- **Pick-up Address:** {{$order->order_pickUpAddress}}
- **Floor:** {{$order->order_pickUpFloor}}
- **Date:** {{date('M d, Y',strtotime($order->order_expectedPickUpDateTime))}}
@if($order->order_pickUpCanUseElevator)
- {{'Clients states there\'s an elevator at pick-up site'}}
@endif
@if ($order->order_pickUpNeedExtraMan)
- {{'Clients needs an extra man'}}
@endif

## Delivery Information
- **Delivery Address:** {{$order->order_deliveryAddress}}
- **Floor:** {{$order->order_dropOffFloor}}
@if ($order->order_dropOffCanUseElevator)
- {{'Clients states there\'s an elevator at delivery site'}}
@endif
@if ($order->order_dropOffNeedExtraMan)
- {{'Clients needs an extra man'}}
@endif

## Client details
- __Full Name:__ {{$order->username}}
- __Email address:__ {{$order->email}}
- __Phone number:__ {{$order->phone}}

For a full-detail order information, check your admin dashboard.
</x-mail::message>
