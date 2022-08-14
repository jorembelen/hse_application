@section('title', 'Users Session List')

<div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatables-reponsive" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>IP Address</th>
                                <th>Device</th>
                                <th>Last Activity</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($sessions as $data)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                        {{ $data->user->name }}
                                </td>
                                <td>{{ $data->ip_address }}</td>
                                <td>{{ $data->user_agent }}</td>
                                <td>{{ date('M-d-Y, h:i a', strtotime($data->getExpiresAtAttribute())) }}</td>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
