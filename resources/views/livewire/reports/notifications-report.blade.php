@section('title', 'Notifications Report')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header">
                        <form wire:submit.prevent="filter">
                            <div class="form-row">
                                @if ($result == false)
                                <div class="form-group col-md-3 sm-3">
                                    <label for="">Filter By Project Location</label>
                                    <div wire:ignore>
                                        <select wire:model="location" class="form-control">
                                            <option value="{{ $location }}">Choose Location</option>
                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3 sm-3">
                                    <label for="">Filter By Incident Type</label>
                                    <div wire:ignore>
                                        <select wire:model="type" class="form-control">
                                            <option value="{{ $type }}">Choose Type</option>
                                            <option value="Fatality">Fatality</option>
                                            <option value="Lost Time Injury">Lost Time Injury</option>
                                            <option value="Dangerous Occurence">Dangerous Occurence</option>
                                            <option value="First Aid">First Aid</option>
                                            <option value="Property Damage">Property Damage</option>
                                            <option value="MTC">MTC</option>
                                            <option value="RWC">RWC</option>
                                            <option value="MVI">MVI</option>
                                            <option value="Near Miss">Near Miss</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 sm-2">
                                    <label for="">Start Date</label>
                                    <div wire:ignore>
                                        <input type="text" id="datepicker" wire:model.defer="start_date" class="form-control" value="{{ request('start_date') }}" placeholder="start date">
                                    </div>
                                    @error('start_date')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2 sm-2">
                                    <label for="">End Date</label>
                                    <div wire:ignore>
                                        <input type="text" id="datepicker2" wire:model.defer="end_date" class="form-control" value="{{ request('end_date') }}" placeholder="end date">
                                    </div>
                                    @error('end_date')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2 sm-2">
                                    <label for="">Filter By Status</label>
                                    <select wire:model.defer="status"  class="form-control">
                                        <option>Choose Status</option>
                                        <option value="false">Awaiting</option>
                                        <option value="1">Closed</option>
                                    </select>
                                </div>
                                @endif
                                <div class="col-auto ml-auto text-right mt-n1" wire:loading.remove wire:target="filter">
                                    <button class="btn btn-primary" type="submit" {{ $result ? 'disabled' : null }}><i class="fas fa-fw fa-filter"></i> Filter</button>
                                    <button class="btn btn-success" wire:click.prevent="refresh" {{ $result ? null : 'disabled' }}><i class="fas fa-fw fa-redo"></i> Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="card-body">
                    <div wire:loading wire:target="filter" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Processing . . .</div>

                    @if ($result)
                    <h1>Total Result: {{ count($incidents) }}</h1>
                    <table id="export-buttons" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Incident Type</th>
                                <th>Safety Officer</th>
                                <th>Project Location</th>
                                <th>WPS</th>
                                <th>Severity</th>
                                <th>Status</th>
                                <th>Date of Incident</th>
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
                                <td>{{ date('Y-m-d', strtotime($incident->date)) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>



</div>

@push('js')
<script src="/assets/flatpickr/flatpickr.js"></script>
<script>
    var f2 = flatpickr(document.getElementById('datepicker'), {
        enableTime: false,
        dateFormat: "Y-m-d",
    });
    var f2 = flatpickr(document.getElementById('datepicker2'), {
        enableTime: false,
        dateFormat: "Y-m-d",
    });
</script>
<script>
    function myFunction(){
        document.getElementById("category").value = "";
        document.getElementById("datepicker").value = "";
        document.getElementById("datepicker2").value = "";
    }
</script>
<script>
    $(document).ready(function () {
        window.addEventListener('reApplySelect2', event => {
            $('#category').select2();
        });
    });
</script>
<script>
    window.addEventListener('refreshComponent', event => {
          var datatablesButtons = $("#export-buttons").DataTable({
            responsive: true,
            lengthChange: !1,
            buttons: 'copy'
        });
        datatablesButtons.buttons().container().appendTo("#export-buttons_wrapper .col-md-6:eq(0)");

    })
</script>
<script>
    document.addEventListener('livewire:load', function () {
        $('#datepicker').flatpickr();
        $('#datepicker2').flatpickr();
    });
    window.addEventListener('refreshDate', event => {
        $(event.detail.componentDate).flatpickr()
    })
</script>
@endpush
