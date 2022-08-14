@extends('layouts.app')


<style>
    .inv {
        height:60px;
    }

    td{
        font-size: 10px;
    }
    .ref {
        font-size: 10px;
    }

    .body{
        margin-top: 0em;
    }

    .channels {
        float: left;
    }
    .revised {
        font-weight: bold;
    }

    .logo-align {
        float: left;
        margin-left: 6em;
        margin-top: 1.2em;
    }

    .center{
        margin-left: 16.5em;
        font-weight: bold;
        font-size: 16px;
        padding-bottom: 0%;
    }

    .center-head{
        font-weight: bold;
        font-size: 16px;
        text-align: absolute;
        margin-left: 15em;
        margin-bottom: 0px;
    }
    .center-middle{
        font-weight: bold;
        font-size: 16px;
        margin-left: 17em;
        margin-top: 0px;
        margin-bottom: 0px;
    }

    .revised{
        font-weight: bold;
    }

    .td-head{
        font-size: 16px;
        font-weight: bold;
    }

    .image-container {
        vertical-align: bottom;
    }

    .image {
        vertical-align: bottom;
    }

</style>

@section('content')

<div class="body">
    <div class="logo-align">
        <img src="{{ url('/admin/assets/img/logo.png') }}" height="60">
    </div>
    <p class="center-head">
        Rezayat Company Limited
    </p>
    <p class="center-middle">HSE Department</p>
    <p class="center">Notification Report</p>


    <br>
    <p class="ref mb-1">RCL-HSE-FM-07.4 - Version 1.0 Rev. Nov 2020</p>
    <div class="">
        <table class="table table-sm table-bordered">
            <tbody>
                <tr>
                    <td class="align-middle revised" width="12%">Company: </td>
                    <td class="align-middle text-justify" width="60%">Rezayat Company Limited</td>
                    <td class="align-middle revised" width="8%">Date: </td>
                    <td class="align-middle text-justify">{{ date('M-d-Y', strtotime($incident->date)) }}</td>
                </tr>
                <tr>
                    <td class="align-middle revised" width="8%">Location: </td>
                    <td class="align-middle text-justify">{{ $incident->locations->loc_name }}</td>
                    <td class="align-middle revised" width="8%">Time: </td>
                    <td class="align-middle text-justify">{{ date('h:i a', strtotime($incident->date)) }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-sm table-bordered">
            <tbody>
                <tr>
                    <td class="align-middle revised" width="18%">Project/Site Name: </td>
                    <td class="align-middle text-justify" width="40%">{{ $incident->locations->name }}</td>
                    <td class="align-middle text-justify revised" width="15%">Actual Severity: </td>
                    <td class="align-middle">{{ $incident->severity }}</td>
                    <td class="align-middle text-left revised" width="23%">Worst Potential Severity: </td>
                    <td class="align-middle">{{ $incident->wps }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-sm table-bordered">
            <tbody>
                <tr>
                    <td class="align-middle revised" width="15%">Persons Involved: </td>
                    <td class="align-middle text-justify" border=1 width="85%">{{ $incident->involved }}</td>
                </tr>
                <tr>
                    <td class="align-middle revised" width="25%">Injury Location by Body Parts: </td>
                    <td class="align-middle text-justify">{{ $incident->injury_location }}</td>
                </tr>
                <tr>
                    <td class="align-middle revised" width="25%">Type of Injury Sustained: </td>
                    <td class="align-middle text-justify">{{ $incident->injury_sustain }}</td>
                </tr>
                <tr>
                    <td class="align-middle revised" width="25%">Immediate Cause(s): </td>
                    <td class="align-middle text-justify">{{ $incident->cause }}</td>
                </tr>
                <tr>
                    <td class="align-middle revised" width="25%">Equipment(s) Involved: </td>
                    <td class="align-middle text-justify">{{ $incident->equipment }}</td>
                </tr>
                {{-- </tbody>
                </table>
                <table class="table table-sm table-bordered">
                    <tbody> --}}
                        <tr>
                            <td class="align-middle revised" width="25%">Description of the Event: </td>
                            <td class="align-middle text-justify">{{ $incident->description }}</td>
                        </tr>
                        <tr>
                            <td class="align-middle revised" width="25%">Immediate Action(s) Taken to Prevent Reoccurance: </td>
                            <td class="align-middle text-justify">{{ $incident->action }}</td>
                        </tr>
                    </tbody>
                </table>
                @if($incident->images)
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Images</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>
                            @foreach ($photos as $photo)
                            <img class="image" src="{{ Storage::disk('s3')->url('files/thumbnail/'.$photo ) }}" height="150">
                            @endforeach
                        </td>
                    </tbody>
                </table>
                @endif
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <td class="text-center revised" width="70%">Person Created the Report: </td>
                            <td class="text-center revised" width="30%">Signature:</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="inv">
                            <td class="align-middle text-center">{{ $incident->officer->badge }} - {{ $incident->officer->name }} ({{ $incident->officer->designation }})</td>
                            <td class="align-middle" width="8%"></td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>

        @endsection
