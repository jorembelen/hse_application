
{{-- Employees --}}

    <!-- Create modal content -->
    <div id="createEmployee" class="modal fade" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Employee </h4>
                    <button type="button" class="close" wire:click.prevent="close">×</button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" wire:submit.prevent="create">

                        <div class="form-group row">
                            <label for="create-name" class="col-md-4 ml-3 col-form-label">Badge</label>
                            <div class="col-md-11 ml-3">
                              <input type="number" class="form-control @error('badge') is-invalid @enderror" wire:model.defer="badge"  placeholder="Badge number">
                              @error('badge')
                              <div class="text-danger">
                                  {{ $message }}
                              </div>
                              @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="create-username" class="col-md-4 ml-3 col-form-label">Name</label>
                            <div class="col-md-11 ml-3">
                              <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.defer="name" placeholder="Name">
                              @error('name')
                              <div class="text-danger">
                                  {{ $message }}
                              </div>
                              @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="create-email" class="col-md-4 ml-3 col-form-label">Designation</label>
                            <div class="col-md-11 ml-3">
                              <input type="text" class="form-control @error('designation') is-invalid @enderror"  wire:model.defer="designation" placeholder="Designation">
                              @error('designation')
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
    <div id="editEmployee" class="modal fade" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Update {{ $name }}? </h4>
                    <button type="button" class="close" wire:click.prevent="close">×</button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" wire:submit.prevent="submit('{{ $employeeId }}')">

                        <div class="form-group row">
                            <label for="create-name" class="col-md-4 ml-3 col-form-label">Badge</label>
                            <div class="col-md-11 ml-3">
                              <input type="number" class="form-control @error('badge') is-invalid @enderror" wire:model.defer="badge"  placeholder="badge number">
                              @error('badge')
                              <div class="text-danger">
                                  {{ $message }}
                              </div>
                              @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="create-username" class="col-md-4 ml-3 col-form-label">Name</label>
                            <div class="col-md-11 ml-3">
                              <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.defer="name" placeholder="Name">
                              @error('name')
                              <div class="text-danger">
                                  {{ $message }}
                              </div>
                              @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="create-email" class="col-md-4 ml-3 col-form-label">Designation</label>
                            <div class="col-md-11 ml-3">
                              <input type="text" class="form-control @error('designation') is-invalid @enderror"  wire:model.defer="designation" placeholder="Designation">
                              @error('designation')
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
