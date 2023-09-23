@section('title', 'Users List')

<div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header">
                        <a class="btn btn-dark float-right" href="#" wire:click.prevent="showCreate"><i class="fas fa-plus-circle"></i> Add</a>
                    </div>
                </div>
                <div class="card-body table-responsive">

                    @include('search.table-search')

                    <table  class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>
                                    <x-filter label="Name" model="name" name="sortColumnName" direction="sortDirection"></x-filter>
                                </th>
                                <th>
                                    <x-filter label="UserName" model="username" name="sortColumnName" direction="sortDirection"></x-filter>
                                </th>
                                <th>Email</th>
                                <th>
                                    <x-filter label="Role" model="role" name="sortColumnName" direction="sortDirection"></x-filter>
                                </th>
                                <th>
                                    <x-filter label="Location" model="location_id" name="sortColumnName" direction="sortDirection"></x-filter>
                                </th>
                                <th>
                                    <x-filter label="Status" model="status" name="sortColumnName" direction="sortDirection"></x-filter>
                                </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            @if (auth()->user()->id != $user->id)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role == 'user' || $user->role == 'site_member')
                                    <span class="badge badge-pills badge-warning">{{ $user->userRole() }}</span>
                                    @else
                                    <span class="badge badge-pills badge-info">{{ $user->userRole() }}</span>
                                    @endif
                                </td>
                                <td>{{ $user->locations->name }}</td>
                                <td>
                                    <a href="#" wire:click.prevent="{{ $user->status === 1 ? 'deactivate' : 'activate' }}('{{ $user->id }}')">
                                        <span class="badge badge-pills badge-{{ $user->status === 1 ? 'primary' : 'danger' }}">{{ $user->status === 1 ? 'Active' : 'Inactive' }}</span>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a role="button" href="#" wire:click.prevent="showEdit('{{ $user->id }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><polyline points="3 6 5 6 21 6"></polyline><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </a>
                                    <a href="#" wire:click.prevent="confirmDelete('{{ $user->id }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 table-cancel"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>


        @include('livewire.admin.user-modal')

    </div>


    @push('recommendation-js')
    <script>
        $(document).ready(function () {
            window.addEventListener('reApplySelect2', event => {
                $('#location').select2();
                $('#locationEdit').select2();
            });
        });
    </script>
    <script>
        $('form').submit(function() {
            @this.set('location_id', $('#location').val());
            @this.set('locationEdit', $('#locationEdit').val());
        })
    </script>
    <script>
        window.addEventListener('show-modal', function (event) {
            $('#editUser').modal('show');
        });
        window.addEventListener('show-create-modal', function (event) {
            $('#createUser').modal('show');
        });
        window.addEventListener('hide-modal', function (event) {
            $('#editUser').modal('hide');
            $('#createUser').modal('hide');
        });
    </script>
    @endpush
