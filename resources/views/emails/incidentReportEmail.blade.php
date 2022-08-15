@component('mail::message')
# {{ $greetings }}

New Notification Report was added to the site. <br>

Type of Incident: <strong>{{ $incident->type }}</strong> <br>
Project Location: <strong>{{ $incident->locations->name }}</strong> <br>

@component('mail::button', ['url' => route('print.incident', $incident->id)])
Click here to view complete details!
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team

<br>

<p class="text-center text-sm">This email is system generated. Do not reply.</p>
@endcomponent
