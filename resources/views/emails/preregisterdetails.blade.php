@component('mail::message')
# Pre-Registration Details
Thank you for pre-registering for an account in our BRU App! Here are the details of your registration:


BRU ID: **{{$user->aan_string}}**


Name: {{$user->first_name}} {{$user->last_name}}


Email: {{$user->email}}

Please follow us on Facebook and Instagram @brumultiverse for the latest updates on the launch.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
