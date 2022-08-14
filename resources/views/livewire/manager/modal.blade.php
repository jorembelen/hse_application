    <!-- Assign modal content -->
    <div id="commentModal" class="modal fade" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Remarks </h4>
                    <button type="button" class="close" wire:click.prevent="close">×</button>
                </div>
                <div class="modal-body">

                        <div class="form-group">
                            <select wire:model.defer="status" class="form-control">
                                <option value="">Choose ...</option>
                                <option value="Best Practice">Best Practice</option>
                                <option value="Satisfactory">Satisfactory</option>
                                <option value="Required Improvement">Required Improvement</option>
                            </select>
                            @error('status')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <textarea rows="3" wire:model.defer="note" class="form-control" placeholder="Write your comments here ..."></textarea>
                            @error('note')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <div wire:loading wire:target="submit" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Processing . . .</div>
                    <div wire:loading wire:target="close" class="progress-bar progress-bar-striped progress-bar-animated mb-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                    <div wire:loading.remove wire:target="close,submit">
                        <button  class="btn btn-dark waves-effect waves-light" wire:click.prevent="submit('{{ $reportId }}')">Submit</button>
                        <a href="#" class="btn btn-danger waves-effect" wire:click.prevent="close">Cancel</a>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
