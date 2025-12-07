<x-mail::message>
# Transport booking payment confirmation

Hello {{$data["username"]}},

We are glad to inform you that your upfront payment of £{{$data["upfront"]}} for transport bookings was successful. Your outstanding payment which 
will be fulfilled upon completion of our services is £{{$data["outstanding"]}}. 

## Transport items
{{implode(", ",json_decode($data["items"]))}}

## Pick-up Information
- **Pick-up Address:** {{$data["pickUpAddress"]}}
- **Floor:** {{$data["pickUpFloor"]}}
- **Date:** {{date('M d, Y h:i K',strtotime($data["expectedPickUpDateTime"]))}}

## Delivery Information
- **Delivery Address:** {{$data["deliveryAddress"]}}
- **Floor:** {{$data["dropOffFloor"]}}
- **Date:** {{date('M d, Y h:i K',strtotime($data["expectedDeliveryDateTime"]))}}

Thanks,<br>
The {{ config('app.name') }}'s team
</x-mail::message>
