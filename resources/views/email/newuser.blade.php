@component('mail::message')
welcome to TEDxfst Team
this is your login data

email : {{$user}}

password : {{$password}}

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
