@section('title', 'Project Locations List')

<div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header">
                        <a class="btn btn-dark float-right" role="button" href="#" wire:click.prevent="showCreate"><i class="fas fa-plus-circle"></i> Add</a>
                    </div>
                </div>
                <div class="card-body table-responsive">

                    @include('search.table-search')

                    <table  class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>ID</th>
                                            <th>Division/Department</th>
                                            <th>Project Name</th>
                                            <th>Location</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($locations as $location)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $location->division }}</td>
                                            <td>{{ $location->name }}</td>
                                            <td>{{ $location->loc_name }}</td>
                                            <td class="text-center">
                                            <a role="button" href="#" wire:click.prevent="showEdit('{{ $location->id }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><polyline points="3 6 5 6 21 6"></polyline><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                            <a href="#" wire:click.prevent="confirmDelete('{{ $location->id }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 table-cancel"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                            </td>
                                        </tr>

                                        @endforeach
                    </table>
                    {{ $locations->links() }}
                </div>
            </div>
        </div>
    </div>

@include('livewire.admin.location-modal')

</div>


@push('recommendation-js')
<script>
    window.addEventListener('show-modal', function (event) {
        $('#editLocation').modal('show');
    });
    window.addEventListener('show-create-modal', function (event) {
        $('#createLocation').modal('show');
    });
    window.addEventListener('hide-modal', function (event) {
        $('#editLocation').modal('hide');
        $('#createLocation').modal('hide');
    });
</script>
@endpush
