<x-mail::message>
# Quote request under evaluation

Hello {{$mailData["client"]}},

We are delighted to inform you that we receieved your Instant Quote request for transportation service from {{$mailData["pickUpAddress"]}} to {{$mailData["dropOffAddress"]}}. We'll reach out to you
through email once your quotation is ready. If you have further inquiries, please do not hesitate to get in touch with us at [{{ config('mail.mainTo.address') }}](mailto:{{ config('mail.mainTo.address') }}) or Whatsapp message on [{{config('app.phone')}}]({{config('app.socials.whatsapp')}}).


Thanks,<br>
{{config('app.name')}}
</x-mail::message>