@section('title', 'Recommendations List')

<div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ session()->has('previousRoute') ? url(session()->get('previousRoute')) : url()->previous() }}" type="button"class="btn btn-dark mb-2 float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-left"><polyline points="9 14 4 9 9 4"></polyline><path d="M20 20v-7a4 4 0 0 0-4-4H4"></path></svg>
                        Back
                    </a>

                </div>
                <div class="card-body table-responsive">

                    @include('search.table-search')

                    <table  class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Notification ID</th>
                                <th>Investigation ID</th>
                                <th>Root Cause</th>
                                <th>Type</th>
                                <th>recommendation</th>
                                <th>Type</th>
                                <th>Status</th>
                                @if(auth()->user()->role == 'user' || auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin')
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($cause as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->incident_id }}</td>
                                <td>
                                    <a class="bs-tooltip" title="Click to view the Report!" href="{{ route('investigation.info', $item->incident_id) }}">{{ $item->report_id }}</a>
                                </td>
                                <td>{{ $item->root_name }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->rec_name }}</td>
                                <td>{{ $item->rec_type }}</td>
                                <td>
                                    @if($item->status == 0)
                                    <span class="badge badge-danger">On Going</span>
                                    @else
                                    <span class="badge badge-info">Done</span>
                                    @endif
                                </td>
                                @if(auth()->user()->role == 'user' || auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin')
                                    @if ($item->status === 0)
                                    <td class="text-center">
                                        <a href="#" wire:click.prevent="showEdit('{{ $item->id }}')"><i class="fa fa-edit"></i></a>
                                    </td>
                                    @endif
                                @endif
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                    {{ $cause->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Assign modal content -->
    <div id="editCause" class="modal fade" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Update ID No. {{ $causeId }} </h4>
                    <button type="button" class="close" wire:click.prevent="close">×</button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" wire:submit.prevent="submit('{{ $causeId }}')" type="multipart">

                        <div class="form-group row">
                            <label for="create-name" class="col-md-4 ml-3 col-form-label">Root Cause</label>
                            <div class="col-md-11 ml-3">
                                <textarea wire:model.defer="root_name" class="form-control" rows="3"></textarea>
                                @error('root_name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="create-username" class="col-md-4 ml-3 col-form-label">Type</label>
                            <div class="col-md-11 ml-3">
                                <select wire:model.defer="type" class="form-control">
                                    <option value="{{ $type }}">{{ $type }}</option>
                                    <option value="People">People</option>
                                    <option value="Process">Process</option>
                                    <option value="Equipment">Equipment</option>
                                    <option value="Workplace">Workplace</option>
                                </select>
                                @error('type')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="create-email" class="col-md-4 ml-3 col-form-label">Recommendation</label>
                            <div class="col-md-11 ml-3">
                                <textarea wire:model.defer="rec_name" class="form-control" rows="3">{{$rec_name}}</textarea>
                                @error('rec_name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="create-email" class="col-md-4 ml-3 col-form-label">Type</label>
                            <div class="col-md-11 ml-3">
                                <select wire:model.defer="rec_type" class="form-control" >
                                    <option value="Elimination">Elimination</option>
                                    <option value="Substitution">Substitution</option>
                                    <option value="Engineering Control">Engineering Control</option>
                                    <option value="Administrative Control">Administrative Control</option>
                                    <option value="PPE Control">PPE Control</option>
                                </select>
                                @error('rec_type')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'super_admin')
                        <div class="form-group row">
                            <label for="create-email" class="col-md-4 ml-3 col-form-label">Status</label>
                            <div class="col-md-11 ml-3">
                                <select wire:model.defer="status" class="form-control" >
                                    <option value="{{ $status }}">
                                        @if($status == 0)
                                        <span class="badge badge-danger">On Going</span>
                                        @else
                                        <span class="badge badge-info">Done</span>
                                        @endif
                                    </option>
                                    <option value="1">Done</option>
                                    <option value="0">On-Going</option>
                                </select>
                                @error('status')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        @endif

                    </div>


                    <div class="modal-footer">
                        <div wire:loading wire:target="submit" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                        <div wire:loading wire:target="close" class="progress-bar progress-bar-striped progress-bar-animated mb-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                        <div wire:loading.remove wire:target="close,submit">
                            <button  class="btn btn-dark waves-effect waves-light" type="submit">Submit</button>
                            <a href="#" class="btn btn-danger waves-effect" wire:click.prevent="close">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</div>


@push('recommendation-js')
<script>
    window.addEventListener('show-modal', function (event) {
        $('#editCause').modal('show');
    });
    window.addEventListener('hide-modal', function (event) {
        $('#editCause').modal('hide');
    });
</script>
@endpush
