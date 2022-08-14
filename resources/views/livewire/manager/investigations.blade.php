@section('title', 'Investigation Reports')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ \URL::previous() }}" type="button"class="btn btn-dark mb-2 float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-left"><polyline points="9 14 4 9 9 4"></polyline><path d="M20 20v-7a4 4 0 0 0-4-4H4"></path></svg>
                        Back
                    </a>
                </div>
                <div class="card-body">
                    <table id="datatables-reponsive" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Notification ID</th>
                                <th>Incident Type</th>
                                <th>Description</th>
                                <th>Line Manager</th>
                                <th>Place of Incident</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($reports as $report)
                            <tr>
                                <td>{{ $report->id }}</td>
                                <td>{{ $report->incident_id }}</td>
                                <td>{{ $report->incident->type }}</td>
                                <td>{{ Str::limit($report->description, 100) }}</td>
                                <td>{{ $report->manager->badge }} - {{ $report->manager->name }} ({{ $report->manager->designation }})</td>
                                <td>{{ $report->inc_loc }}</td>
                                <td class="text-center">
                                    <a href="{{ route('investigations.comment', $report->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-eye" data-toggle="tooltip" data-placement="top" data-original-title="View"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </a>
                                    <a href="{{ route('report.recommendation', $report->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-help-circle" data-toggle="tooltip" data-placement="top" data-original-title="Recommendations"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                    </a>
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
