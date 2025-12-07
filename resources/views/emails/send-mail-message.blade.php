<x-mail::message>
# {{$mailData['subject']}}

{{$mailData['body']}}



Thanks,<br>
{{config('app.name')}}
</x-mail::message>