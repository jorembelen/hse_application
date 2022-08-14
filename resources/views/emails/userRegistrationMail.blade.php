@component('mail::message')
# Welcome to the HSE APP {{ $user->name }}.

Please click the button below to proceed to HSE APP login page. <br>
Your username is: <strong>{{ $user->username }}</strong> <br>
Password: <strong>{{ $password }}</strong>

@component('mail::button', ['url' => route('home')])
Click Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
