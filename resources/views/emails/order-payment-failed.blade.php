<x-mail::message>
# Your payment failed

Hello {{$data['username']}},

We regret to inform you that your {{$data['upfront']}} transport booking Reservation payment with Reference Number: {{$data["refNo"]}} was unsuccessful. We sincerely apologize for any inconvenience this may have caused.

Please return to our platform to re-book your transport, and our team will prioritize your request with the utmost urgency.

Alternatively, you may consider using our WhatsApp booking service, which allows you to interact with a live agent and make payments via bank transfer. If this option suits you, please visit our [Whatsapp checkout](https://mazmoves.com/get-an-instant-quote/delivery-items-details) page.

If you have any further questions, feel free to reply to this email. We're here to assist you.

Thanks,<br>
The {{ config('app.name') }}'s team
</x-mail::message>
