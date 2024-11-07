@component('mail::message')

<div style="text-align: center; background-color: #f0f0f0; padding: 10px;">
    <img src="{{ "data:image/png;base64,".base64_encode(file_get_contents($incident['logo'])) }}" alt="Company Logo" width="100" height="50" style="vertical-align: middle;">
    <span style="vertical-align: middle; margin-left: 10px; font-size: 25px;">Rezayat Company Ltd.</span>
</div>
<br>

# {{ $greetings }},

New Notification Report was added to the site. <br>

<table style="border-collapse: collapse; width: 100%;">
    <thead>
    <tbody>
            <tr>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px; font-size: 12px;">Type of Incident:</td>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px; font-size: 12px;">{{ $incident->type }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px; font-size: 12px;">Project Location:</td>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px; font-size: 12px;">{{ $incident->locations->name }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px; font-size: 12px;">Submitted by:</td>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px; font-size: 12px;">{{ $incident->user->name }}</td>
            </tr>
    </tbody>
</table>

{{-- Type of Incident: <strong>{{ $incident->type }}</strong> <br>
Project Location: <strong>{{ $incident->locations->name }}</strong> <br> --}}

@php
$domainUrl = config('app.domain_url');
$url = "$domainUrl/incident/{$incident->id}/details";
@endphp

@component('mail::button', ['url' => $url])
{{-- @component('mail::button', ['url' => route('print.incident', $incident->id)]) --}}
View Details
@endcomponent

<br>
Thanks,<br>
{{ config('app.name') }} Team <br>
<small style="font-size: 80%; color: #777;">This is a system-generated email. Do not reply.</small>
@endcomponent
