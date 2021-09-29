@component('mail::message')
# Pre-Registration Details

BRU ID: **{{$user->aan_string}}**


Name: {{$user->first_name}} {{$user->last_name}}


Email: {{$user->email}}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
