@section('title', 'Employees List')

<div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header">
                        <x-c-header name="Total Employees: {{ number_format($total,) }}"></x-c-header>
                    </div>
                </div>
                <div class="card-body table-responsive">

                    @include('search.table-search')

                    <table  class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>ID</th>
                                            <th>Badge</th>
                                            <th>Name</th>
                                            <th><x-filter label="Designation" model="designation" name="sortColumnName" direction="sortDirection"></x-filter></th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $employee->id }}</td>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->designation }}</td>
                                            <td class="text-center">
                                            <a role="button" href="#" wire:click.prevent="showEdit('{{ $employee->id }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><polyline points="3 6 5 6 21 6"></polyline><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                            <a href="#" wire:click.prevent="confirmDelete('{{ $employee->id }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 table-cancel"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </a>
                                            </td>
                                        </tr>

                                        @endforeach
                    </table>
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>

@include('livewire.admin.employee-modal')

</div>


@push('recommendation-js')
<script>
    window.addEventListener('show-modal', function (event) {
        $('#editEmployee').modal('show');
    });
    window.addEventListener('show-create-modal', function (event) {
        $('#createEmployee').modal('show');
    });
    window.addEventListener('hide-modal', function (event) {
        $('#editEmployee').modal('hide');
        $('#createEmployee').modal('hide');
    });
</script>
@endpush
