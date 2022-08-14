@section('title', 'Notification Report')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatables-reponsive" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Incident Type</th>
                                <th>Safety Officer</th>
                                <th>Project Location</th>
                                <th>WPS</th>
                                <th>Severity</th>
                                <th>Status</th>
                                <th>Date & Time of Incident</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($incidents as $incident)
                            <tr>
                                <td>{!! $incident->id !!}</td>
                                <td>{{ $incident->type }}</td>
                                <td>{{ $incident->officer->badge ? $incident->officer->badge .' - '. $incident->officer->name .' (' .$incident->officer->designation .')' : null }}</td>
                                <td>{{ $incident->locations->name }}</td>
                                <td>{{ $incident->wps }}</td>
                                <td>{{ $incident->severity }}</td>
                                <td>
                                    @if($incident->status == 0)
                                    <span class="badge badge-danger">Awaiting</span>
                                    @else
                                    <span class="badge badge-info">Closed</span>
                                    @endif


                                </td>
                                <td>{{ date('Y-m-d h:i a', strtotime($incident->date)) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('incident.info', $incident->id) }}"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</div>

