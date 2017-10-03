@component('mail::message')
Please activate your account.

@component('mail::button', [ 'url' => route('user.activate', $token) ])
Activate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
