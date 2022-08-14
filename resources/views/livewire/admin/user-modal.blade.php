
{{-- Users --}}

<!-- Edit modal content -->
<div id="createUser" class="modal fade" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add User </h4>
                <button type="button" class="close" wire:click.prevent="close">×</button>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" wire:submit.prevent="create">

                    <div class="form-group row">
                        <label for="create-username" class="col-md-4 ml-3 col-form-label">Name</label>
                        <div class="col-md-11 ml-3">
                            <input type="text" class="form-control mb-2" wire:model.defer="name" placeholder="Name">
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
                            <input type="text" class="form-control mb-2" wire:model.defer="username"  placeholder="Username">
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
                            <input type="email" class="form-control mb-4"  wire:model.defer="email" placeholder="Email">
                            @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-email" class="col-md-4 ml-3 col-form-label">User Role</label>
                        <div class="col-md-11 ml-3">
                            <select wire:model="role" class="form-control">
                                <option value="">Choose ...</option>
                                <option value="admin">Admin</option>
                                <option value="user">Site User</option>
                                <option value="site_member">Site Member</option>
                                <option value="gm">GM</option>
                                <option value="hsem">HSEM</option>
                                <option value="hse-member">HSE Member</option>
                                <option value="member">Member</option>
                            </select>
                            @error('role')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row" style="{{ $role === 'user' ? null : 'display:none' }}">
                        <label for="create-email" class="col-md-4 ml-3 col-form-label">Location</label>
                        <div class="col-md-11 ml-3">
                            <div wire:ignore>
                                <select wire:change="$emit('classChanged', $event.target.value)" class="form-control select2" id="location">
                                    <option value="">Choose ...</option>
                                    @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('location_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div wire:loading wire:target="create" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Processing . . .</div>
                    <div wire:loading wire:target="close" class="progress-bar progress-bar-striped progress-bar-animated mb-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                    <div wire:loading.remove wire:target="close,create">
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
<!-- Edit modal content -->
<div id="editUser" class="modal fade" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Update {{ $name }} ?</h4>
                <button type="button" class="close" wire:click.prevent="close">×</button>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" wire:submit.prevent="submit('{{ $userId }}')">

                    <div class="form-group row">
                        <label for="create-username" class="col-md-4 ml-3 col-form-label">Name</label>
                        <div class="col-md-11 ml-3">
                            <input type="text" class="form-control mb-2" wire:model.defer="name" placeholder="Name">
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
                            <input type="text" class="form-control mb-2" wire:model.defer="username"  placeholder="Username">
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
                            <input type="email" class="form-control mb-4"  wire:model.defer="email" placeholder="Email">
                            @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-email" class="col-md-4 ml-3 col-form-label">User Role</label>
                        <div class="col-md-11 ml-3">
                            <select wire:model="role" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                <option value="site_member">Site Member</option>
                                <option value="gm">GM</option>
                                <option value="hsem">HSEM</option>
                                <option value="hse-member">HSE Member</option>
                                <option value="member">Member</option>
                            </select>
                            @error('role')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row" style="{{ $role === 'user' ? null : 'display:none' }}">
                        <label for="create-email" class="col-md-4 ml-3 col-form-label">Location</label>
                        <div class="col-md-11 ml-3">
                            <div wire:ignore>
                                <select wire:model.defer="location_id" class="form-control" id="locationEdit">
                                    @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('location_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

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


