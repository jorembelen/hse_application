

                <div class="form-group col-md-3">
                    <input type="text" class="form-control" wire:model.defer="root_name.0" placeholder="root cause description . . ." >
                    @error('root_name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-md-2">
                    <select type="text" wire:model.defer="root_description.0" class="form-control" >
                        <option value="">Choose Type</option>
                        <option value="People">People</option>
                        <option value="Process">Process & Procedure</option>
                        <option value="Equipment">Equipment</option>
                        <option value="Workplace">Workplace</option>
                    </select>
                    @error('root_description')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <input type="text" class="form-control" wire:model.defer="rec_name.0" placeholder="recommendation . . ." >
                    @error('rec_name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-md-2">
                    <select type="text" wire:model.defer="rec_type.0" class="form-control" >
                        <option value="">Choose Type</option>
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

                <div class="form-group col-md-2 ">
                    <button class="btn btn-primary btn-sm " wire:click.prevent="add('{{ $i }}')"><i class="fa fa-plus-circle mr-1"></i> Add More</button>
                </div>

                @foreach($inputs as $key => $value)

                <div class="form-group col-md-3">
                    <input type="text" class="form-control" wire:model.defer="root_name.{{ $value }}" placeholder="root cause description . . ." >
                    @error('root_name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-md-2">
                    <select type="text" wire:model.defer="root_description.{{ $value }}" class="form-control" >
                        <option value="">Choose Type</option>
                        <option value="People">People</option>
                        <option value="Process">Process & Procedure</option>
                        <option value="Equipment">Equipment</option>
                        <option value="Workplace">Workplace</option>
                    </select>
                    @error('root_description')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <input type="text" class="form-control" wire:model.defer="rec_name.{{ $value }}" placeholder="recommendation . . ." >
                    @error('rec_name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-md-2">
                    <select type="text" wire:model.defer="rec_type.{{ $value }}" class="form-control" >
                        <option value="">Choose Type</option>
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
                <div class="form-group col-md-2 ">
                    <label for="rec_type"></label>
                    <button class="btn btn-danger btn-sm " wire:click.prevent="remove({{$key}})"><i class="fa fa-trash mr-1"></i> Remove</button>
                </div>
                @endforeach
