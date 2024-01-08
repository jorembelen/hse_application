@component('mail::message')

<div style="text-align: center; background-color: #f0f0f0; padding: 10px;">
    <img src="{{ "data:image/png;base64,".base64_encode(file_get_contents($user['logo'])) }}" alt="Company Logo" width="100" height="50" style="vertical-align: middle;">
    <span style="vertical-align: middle; margin-left: 10px; font-size: 25px;">Rezayat Company Ltd.</span>
</div>
<br>

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
