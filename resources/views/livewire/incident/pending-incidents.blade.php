@section('title', 'Notification Report')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-dark float-right" role="button" href="{{ route('admin.create-notifications') }}"><i class="fas fa-plus-circle"></i> Add</a>

                </div>
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
                                <td>
                                    <a href="{{ route('incident.info', $incident->id) }}">{{ $incident->type }}</a>
                                </td>
                                <td>{{ $incident->officer->badge ? $incident->officer->badge .' - '. $incident->officer->name .' (' .$incident->officer->designation .')' : null }}</td>
                                <td>{{ $incident->locations->name }}</td>
                                <td>{{ $incident->wps }}</td>
                                <td>{{ $incident->severity }}</td>
                                <td>
                                    @if($incident->status == 0)
                                    <a class="bs-tooltip" title="Click to add Investigation Report!"
                                    @if(auth()->user()->role == 'user' || auth()->user()->role == 'admin' || auth()->user()->role == 'super_admin')
                                    href="{{ route('admin.create-investigation', $incident->id) }}"
                                    @endif
                                    ><span class="badge badge-danger">Awaiting</span></a>
                                    @else
                                    <a href="{{ route('investigation.info', $incident->id) }}"> <span class="badge badge-info">Closed</span></a>
                                    @endif


                                </td>
                                <td>{{ date('Y-m-d h:i a', strtotime($incident->date)) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('print', $incident->id) }}" target="_blank" rel="noopener noreferrer"><i class="fa fa-print"></i></a>
                                    @if(in_array(auth()->user()->role, ['user', 'admin', 'super_admin']))
                                        @if($incident->status != 1)
                                        <a href="{{ route('edit.incident', $incident->id) }}"><i class="fa fa-edit"></i></a>
                                        @endif
                                    @endif
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

