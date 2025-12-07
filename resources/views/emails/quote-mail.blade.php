<x-mail::message>
# Instant quote request

## Contact Details
*Full name:* {{$order->username}}
*Email Address:* {{$order->email}} 
*Phone:* {{$order->phone}}

## Delivery items
{{implode(", ",json_decode($order->order_items))}}

## Transportation Details

### Pick-up Information
*Pick-up Address:* {{$order->order_pickUpAddress}}
*Post code:* {{$order->order_pickUpPostCode}}
*Floor:* {{$order->order_pickUpFloor}}
*Can elevator be used:* {{$order->order_pickUpCanUseElevator ? 'Yes' : 'No'}}
*Extra man needed:* {{$order->order_pickUpNeedExtraMan ? 'Yes' : 'No'}}
*Date:* {{date('M d, Y h:i K',strtotime($order->order_expectedPickUpDateTime))}}

### Delivery Information
*Delivery Address:* {{$order->order_deliveryAddress}}
*Post code:* {{$order->order_dropOffPostCode}}
*Floor:* {{$order->order_dropOffFloor}}
*Can elevator be used:* {{$order->order_dropOffCanUseElevator ? 'Yes' : 'No'}}
*Extra man needed:* {{$order->order_dropOffNeedExtraMan ? 'Yes' : 'No'}}
*Date:* {{date('M d, Y h:i K',strtotime($order->order_expectedDeliveryDateTime))}}



Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
