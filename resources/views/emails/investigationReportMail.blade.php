@component('mail::message')
# {{ $greetings }}

Notification Report {{ $report->incident_id }} was closed. <br><br>
Investigation ID: {{ $report->id }} <br><br>
Project Location: {{ $report->location->name }} <br>

@component('mail::button', ['url' => route('print.report-details', $report->id)])
Click here to view complete details!
@endcomponent

<br><br>

Thanks,<br>
{{ config('app.name') }} Team

<br>

<p class="text-center text-sm">This email is system generated. Do not reply.</p>
@endcomponent
