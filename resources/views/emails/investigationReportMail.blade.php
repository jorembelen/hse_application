@component('mail::message')

<div style="text-align: center; background-color: #f0f0f0; padding: 10px;">
    <img src="{{ "data:image/png;base64,".base64_encode(file_get_contents($report['logo'])) }}" alt="Company Logo" width="100" height="50" style="vertical-align: middle;">
    <span style="vertical-align: middle; margin-left: 10px; font-size: 25px;">Rezayat Company Ltd.</span>
</div>
<br>

# {{ $greetings }},

Notification Report {{ $report->incident_id }} was closed. <br><br>

<table style="border-collapse: collapse; width: 100%;">
    <thead>
    <tbody>
            <tr>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px; font-size: 12px;">Investigation ID:</td>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px; font-size: 12px;">{{ $report->id }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px; font-size: 12px;">Project Location:</td>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px; font-size: 12px;">{{ $report->location->name }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px; font-size: 12px;">Submitted by:</td>
                <td style="border: 1px solid #dddddd; text-align: left; padding: 8px; font-size: 12px;">{{ $report->user->name }}</td>
            </tr>
    </tbody>
</table>

@php
$domainUrl = config('app.domain_url');
$url = "$domainUrl/investigation/{$report->id}/details";
@endphp

@component('mail::button', ['url' => $url])
{{-- @component('mail::button', ['url' => route('print.report-details', $report->id)]) --}}
View Details
@endcomponent

<br><br>

Thanks,<br>
{{ config('app.name') }} Team <br>
<small style="font-size: 80%; color: #777;">This is a system-generated email. Do not reply.</small>
@endcomponent
