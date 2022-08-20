@section('title', 'User Profile')

<div>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 col-xl-6">
            <div class="card mb-3">
                <div class="card-body text-center">
                    @if (auth()->user()->profile_pic)
                    <img src="{{ auth()->user()->getAvatar() }}" alt="{{ auth()->user()->name }}" class="img-fluid rounded-circle " width="128" height="128">
                    @else
                    <div wire:ignore>
                        <img avatar="{{ auth()->user()->name }}" alt="{{ auth()->user()->name }}" class="img-fluid rounded-circle " width="128" height="128">
                    </div>
                    @endif
                    <h5 class="card-title mb-0">{{ auth()->user()->name }}</h5>
                    <div class="text-muted ">{{ auth()->user()->email }}</div>

                    <div>
                        <a class="btn btn-primary btn-sm" href="#" wire:click.prevent="showEdit('{{ auth()->id() }}')">Update</a>
                    </div>
                </div>

                <hr class="my-0">
                <div class="card-body">
                    <h5 class="h6 card-title">Username</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock align-middle mr-2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                            {{ auth()->user()->username }}

                        </ul>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <h5 class="h6 card-title">Role</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user align-middle mr-2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                {{ auth()->user()->userRole() }}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>

            <!-- Edit modal content -->
            <div id="editUser" class="modal fade" wire:ignore.self>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Update Profile?</h4>
                            <button type="button" class="close" wire:click.prevent="close">×</button>
                        </div>
                        <div class="modal-body">

                            <form class="form-horizontal" wire:submit.prevent="submit('{{ $userId }}')">

                                <div class="form-group row">
                                    <label for="create-username" class="col-md-4 ml-3 col-form-label">Name</label>
                                    <div class="col-md-11 ml-3">
                                        <input type="text" class="form-control " wire:model.defer="name" placeholder="Name">
                                        @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="create-name" class="col-md-4 ml-3 col-form-label">Username</label>
                                    <div class="col-md-11 ml-3">
                                        <input type="text" class="form-control " wire:model.defer="username"  placeholder="Username">
                                        @error('username')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="create-email" class="col-md-4 ml-3 col-form-label">Email</label>
                                    <div class="col-md-11 ml-3">
                                        <input type="email" class="form-control"  wire:model.defer="email" placeholder="Email">
                                        @error('email')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <a href="#" class="badge badge-{{ $editPass ? 'danger' : 'primary' }} mt-3 float-right" wire:click.prevent="editPassword">{{ $editPass ? 'Cancel' : 'Change Password' }}</a>
                                    </div>
                                </div>
                                @if ($editPass)
                                <div class="form-group row">
                                    <label for="create-email" class="col-md-4 ml-3 col-form-label">Password</label>
                                    <div class="col-md-11 ml-3">
                                        <input type="{{ $showPass ? 'text' : 'password' }}" class="form-control"  wire:model.defer="password" placeholder="password">
                                        @error('password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="create-email" class="col-md-4 ml-3 col-form-label">Confirm Password</label>
                                    <div class="col-md-11 ml-3">
                                        <input type="{{ $showPass ? 'text' : 'password' }}"  class="form-control"  wire:model.defer="password_confirmation" placeholder="confirm password">
                                        @error('password_confirmation')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <label class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" wire:model="showPass" value="1">
                                            <span class="form-check-label">
                                                Show Password
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="create_confirm" class="col-md-4 ml-3 col-form-label">Profile Pic</label>
                                            <div class="col-md-11 ml-3">
                                                <input type="file" class="form-control" wire:model.defer="profile_pic" id="upload{{ $iteration }}">
                                                @error('profile_pic')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" wire:loading.remove wire:target="profile_pic">
                                        @if ($profile_pic)
                                        <img src="{{ $profile_pic->temporaryUrl() }}" alt="{{ $profile_pic }}" class="img-fluid rounded-circle ml-4">
                                        @else
                                        <div wire:ignore>
                                            @if (auth()->user()->profile_pic)
                                            <img src="{{ auth()->user()->getAvatar() }}" alt="{{ auth()->user()->name }}" class="img-fluid rounded-circle ml-4">
                                            @else
                                            <img avatar="{{ auth()->user()->name }}" alt="{{ auth()->user()->name }}" class="img-fluid rounded-circle ml-4">
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 mt-4" wire:loading wire:target="profile_pic">
                                        @include('spinner.uploading-images')
                                    </div>
                                </div>

                            </div>


                            <div class="modal-footer">
                                <div wire:loading wire:target="submit" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Processing . . .</div>
                                <div wire:loading wire:target="close" class="progress-bar progress-bar-striped progress-bar-animated " role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                                <div wire:loading.remove wire:target="close, submit, profile_pic">
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
                $('#editUser').modal('show');
            });
            window.addEventListener('hide-modal', function (event) {
                $('#editUser').modal('hide');
            });
        </script>
        @endpush
