@section('title', 'Create Investigation Report')

<div>

        {{-- This is for the Loading Spinner --}}
        <div class="d-flex align-items-center mt-4">
            <div class="container"  wire:loading wire:target="create">
                <div class="row">
                    <div class="col">
                        <img src="{{ asset('assets/img/loading.gif') }}" alt="" class="d-block m-auto" height="150">
                    </div>
                </div>
            </div>
        </div>

    <div class="row" wire:loading.remove wire:target="create">
        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4>Notification ID: {{ $incidentId }}</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="create('{{ $incidentId }}')">

                        <div class="form-row">


                            <div class="form-group col-md-6">
                                <label for="mgr_name">Line Managers Name<span class="text-danger"> *</span></label>
                                <div wire:ignore>
                                    <select wire:change="$emit('classChanged', $event.target.value)" id="mgr_name" class="form-control select2" >
                                        <option value="">Choose ...</option>
                                        @foreach( $officers as $officer)
                                        <option value="{{$officer->id}}" @if (old('mgr_name') == $officer->id ) selected="selected" @endif>{{$officer->badge}} - {{$officer->name}} ({{$officer->designation}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('mgr_name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sup_name">Supervisors Name<span class="text-danger"> *</span></label>
                                <div wire:ignore>
                                    <select wire:change="$emit('classChanged', $event.target.sup)" id="sup_name" class="form-control select2" >
                                        <option value="">Choose ...</option>
                                        <option value="None">None</option>
                                        @foreach( $officers as $officer)
                                        <option value="{{$officer->id}}" @if (old('sup_name') == $officer->id ) selected="selected" @endif>{{$officer->badge}} - {{$officer->name}} ({{$officer->designation}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('sup_name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inc_loc">Place of the Incident/Injury<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" wire:model.defer="inc_loc" placeholder="Place of the Incident/Injury" >
                                @error('inc_loc')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nature">Nature of the Incident/Injury<span class="text-danger"> *</span></label>
                                <select wire:model.defer="nature" class="form-control" >
                                    <option value="">Choose ...</option>
                                    <option value="Occupational" @if (old('nature') == 'Occupational') selected="selected" @endif>Occupational</option>
                                    <option value="Road Traffic" @if (old('nature') == 'Road Traffic') selected="selected" @endif>Road Traffic</option>
                                    <option value="None" @if (old('nature') == 'None') selected="selected" @endif>None</option>
                                </select>
                                @error('nature')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="other">Specify<span class="text-danger"> *</span></label>
                                <input value="{{ old('other') }}" wire:model.defer="other" class="form-control" type="text" placeholder="Please specify . . ." >
                                @error('other')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="description">Brief Description of the Incident/Injury<span class="text-danger"> *</span></label>
                                <textarea class="form-control" wire:model.defer="description" placeholder="Write your Brief Description of the Incident/Injury here ..." >{{ old('description') }}</textarea>
                                @error('description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="details">Details of the Injury (Specify affected body parts)<span class="text-danger"> *</span></label>
                                <textarea class="form-control" wire:model.defer="details" placeholder="Write your Details of the Injury here ..." >{{ old('details') }}</textarea>
                                @error('details')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group {{ $aid !== 'Yes' ? 'col-md-12' : 'col-md-6' }}">
                                <label for="aid">First Aid Given?<span class="text-danger"> *</span></label>
                                <select wire:model="aid" class="form-control" id="frst_aid" >
                                    <option value="">Choose ...</option>
                                    <option value="Yes" @if (old('aid') == 'Yes') selected="selected" @endif>Yes</option>
                                    <option value="No" @if (old('aid') == 'No') selected="selected" @endif>No</option>
                                </select>
                                @error('aid')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6" style="{{ $aid === 'Yes' ? null : 'display:none' }}">
                                <label for="aider">Name of First Aider<span class="text-danger"> </span></label>
                                <div wire:ignore>
                                    <select wire:change="$emit('classChanged', $event.target.aider)" id="aider" class="form-control select2">
                                        <option value="">Choose ...</option>
                                        @foreach( $officers as $officer)
                                        <option value="{{$officer->id}}">{{$officer->badge}} - {{$officer->name}} ({{$officer->designation}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('aider')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group {{ $hosp !== 'Yes' ? 'col-md-12' : 'col-md-2' }}">
                                <label for="hosp">Hospitalized?<span class="text-danger"> *</span></label>
                                <select wire:model="hosp" class="form-control">
                                    <option value="">Choose ...</option>
                                    <option value="Yes" @if (old('hosp') == 'Yes') selected="selected" @endif>Yes</option>
                                    <option value="No" @if (old('hosp') == 'No') selected="selected" @endif>No</option>
                                </select>
                                @error('hosp')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4" style="{{ $hosp === 'Yes' ? null : 'display:none' }}">
                                <label for="hospital">Name of Hospital where patient was treated/transferred<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" value="{{ old('hospital') }}" wire:model.defer="hospital" placeholder="Name of hospital">
                                @error('hospital')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6" style="{{ $hosp === 'Yes' ? null : 'display:none' }}">
                                <label for="hos_addr">Address/Location of the hospital<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" value="{{ old('hos_addr') }}" wire:model.defer="hos_addr" placeholder="Address of hospital">
                                @error('hos_addr')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group {{ $med_leave !== 'Yes' ? 'col-md-12' : 'col-md-6' }}">
                                <label for="med_leave">Medical leave given by administering Hospital/Clinic or Doctor?<span class="text-danger"> *</span></label>
                                <select wire:model="med_leave" class="form-control">
                                    <option value="">Choose ...</option>
                                    <option value="Yes" @if (old('med_leave') == 'Yes') selected="selected" @endif>Yes</option>
                                    <option value="No" @if (old('med_leave') == 'No') selected="selected" @endif>No</option>
                                </select>
                                @error('med_leave')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6" style="{{ $med_leave === 'Yes' ? null : 'display:none' }}">
                                <label for="leave_days">Number of Days<span class="text-danger"> *</span></label>
                                <input type="number" min="1" class="form-control" value="{{ old('leave_days') }}" wire:model.defer="leave_days" placeholder="Number of Days">
                                @error('leave_days')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group {{ $prop_dam !== 'Yes' ? 'col-md-12' : 'col-md-3' }}">
                                <label for="prop_dam">Property damage?<span class="text-danger"> *</span></label>
                                <select wire:model="prop_dam" class="form-control">
                                    <option value="">Choose ...</option>
                                    <option value="Yes" @if (old('prop_dam') == 'Yes') selected="selected" @endif>Yes</option>
                                    <option value="No" @if (old('prop_dam') == 'No') selected="selected" @endif>No</option>
                                </select>
                                @error('prop_dam')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3" style="{{ $prop_dam === 'Yes' ? null : 'display:none' }}">
                                <label for="est_dam">Est. percentage of damage<span class="text-danger"> </span></label>
                                <input type="text" class="form-control" value="{{ old('est_dam') }}" wire:model.defer="est_dam" placeholder="Estimated percentage of damage">
                                @error('est_dam')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3" style="{{ $prop_dam === 'Yes' ? null : 'display:none' }}">
                                <label for="est_amt">Est. Cost of damaged (SAR)<span class="text-danger"> </span></label>
                                <input type="text" class="form-control" value="{{ old('est_amt') }}" wire:model.defer="est_amt" placeholder="Estimated Cost of damaged (SAR)">
                                @error('est_amt')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3" style="{{ $prop_dam === 'Yes' ? null : 'display:none' }}">
                                <label for="property">Type / Function of the property<span class="text-danger"> </span></label>
                                <input type="text" class="form-control" value="{{ old('property') }}" wire:model.defer="property" placeholder="Type / Function of the property">
                                @error('property')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4" style="{{ $prop_dam === 'Yes' ? null : 'display:none' }}">
                                <label for="prop_loc">Location of affected property <span class="text-danger"> </span></label>
                                <input type="text" class="form-control" value="{{ old('prop_loc') }}" wire:model.defer="prop_loc" placeholder="Location of affected property">
                                @error('prop_loc')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4" style="{{ $prop_dam === 'Yes' ? null : 'display:none' }}">
                                <label for="prop_manuf">Name of Manufacturer<span class="text-danger"> </span></label>
                                <input type="text" class="form-control" value="{{ old('prop_manuf') }}" wire:model.defer="prop_manuf" placeholder="Type / Function of the property">
                                @error('prop_manuf')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4" style="{{ $prop_dam === 'Yes' ? null : 'display:none' }}">
                                <label for="prop_model">Model of the Property <span class="text-danger"> </span></label>
                                <input type="text" class="form-control" value="{{ old('prop_model') }}" wire:model.defer="prop_model" placeholder="Model of the Property">
                                @error('prop_model')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4" style="{{ $prop_dam === 'Yes' ? null : 'display:none' }}">
                                <label for="prop_plate">Plate Number<span class="text-danger"> </span></label>
                                <input type="text" class="form-control" value="{{ old('prop_plate') }}" wire:model.defer="prop_plate" placeholder="Plate Number">
                                @error('prop_plate')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4" style="{{ $prop_dam === 'Yes' ? null : 'display:none' }}">
                                <label for="prop_reg">Vehicle Registration Number <span class="text-danger"> </span></label>
                                <input type="text" class="form-control" value="{{ old('prop_reg') }}" wire:model.defer="prop_reg" placeholder="Vehicle Registration Number">
                                @error('prop_reg')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4" style="{{ $prop_dam === 'Yes' ? null : 'display:none' }}">
                                <label for="prop_rte">Company Fleet Number<span class="text-danger"> </span></label>
                                <input type="text" class="form-control" value="{{ old('prop_rte') }}" wire:model.defer="prop_rte" placeholder="Company Fleet Number">
                                @error('prop_rte')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="toolbox">Was Pre- Task / Toolbox meeting conducted <span class="text-danger"> *</span></label>
                                <select wire:model.defer="toolbox" class="form-control">
                                    <option value="">Choose ...</option>
                                    <option value="Yes" @if (old('toolbox') == 'Yes') selected="selected" @endif>Yes</option>
                                    <option value="No" @if (old('toolbox') == 'No') selected="selected" @endif>No</option>
                                </select>
                                @error('toolbox')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="ppe">Was the person using   Personal Protective Equipment (PPE) <span class="text-danger"> *</span></label>
                                <select wire:model="ppe" class="form-control">
                                    <option value="">Choose ...</option>
                                    <option value="Yes" @if (old('ppe') == 'Yes') selected="selected" @endif>Yes</option>
                                    <option value="No" @if (old('ppe') == 'No') selected="selected" @endif>No</option>
                                </select>
                                @error('ppe')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-5 col-xl-5" style="{{ $ppe === 'Yes' ? null : 'display:none' }}">
                                <label for="ppe_equip">Specify the Personal Protective Equipment (PPE)  <span class="text-danger"> </span></label>
                                <input type="text" class="form-control" value="{{ old('ppe_equip') }}" wire:model.defer="ppe_equip" placeholder="Enter data here . . .">
                                @error('ppe_equip')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emp_doing">What was the injured person/employee doing at the time of the incident?  <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" value="{{ old('emp_doing') }}" wire:model.defer="emp_doing" placeholder="Enter data here . . ." >
                                @error('emp_doing')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emp_machine">What was the machine/equipment doing at the time of the incident?  <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" value="{{ old('emp_machine') }}" wire:model.defer="emp_machine" placeholder="Enter data here . . ." >
                                @error('emp_machine')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="emp_material">What was the material(s) / substance(s) doing at the time of the incident  <span class="text-danger"> *</span></label>
                                <textarea class="form-control" wire:model.defer="emp_material" placeholder="Write your data here ..." >{{ old('emp_material') }}</textarea>
                                @error('emp_material')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="imm_cause">Immediate Cause(s) of the Incident/injury:<span class="text-danger"> *</span></label>
                                <textarea class="form-control" wire:model.defer="imm_cause" placeholder="Write your data here ..." >{{ old('imm_cause') }}</textarea>
                                @error('imm_cause')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <h3>Root Cause(s) and Recommendation of Incident/injury:</h3>
                            </div>

                            @include('livewire.admin.rootcause')

                            <div class="form-group {{ $witness !== 'Yes' ? 'col-md-12' : 'col-md-6' }}">
                                <label for="witness">Were there any witnesses?<span class="text-danger"> *</span></label>
                                <select wire:model="witness" class="form-control" id="witness_frm" >
                                    <option value="">Choose ...</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                @error('witness')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6" style="{{ $witness === 'Yes' ? null : 'display:none' }}">
                                <label for="wit_type">Type of witness(es)<span class="text-danger"> </span></label>
                                <select wire:model.defer="wit_type" class="form-control select2">
                                    <option value="">Choose ...</option>
                                    <option value="Employee" @if (old('wit_type') == 'Employee') selected="selected" @endif>Employee</option>
                                    <option value="Public" @if (old('wit_type') == 'Public') selected="selected" @endif>Public</option>
                                </select>
                                @error('wit_type')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6" style="{{ $witness === 'Yes' ? null : 'display:none' }}">
                                <label for="wit_details">Witness Details:<span class="text-danger"> *</span></label>
                                <textarea class="form-control" wire:model.defer="wit_details" placeholder="Write your data here ...">{{ old('wit_details') }}</textarea>
                                @error('wit_details')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6" style="{{ $witness === 'Yes' ? null : 'display:none' }}">
                                <label for="wit_statement">Witness Statement:<span class="text-danger"> *</span></label>
                                <textarea class="form-control" wire:model.defer="wit_statement" placeholder="Write your data here ..."></textarea>
                                @error('wit_statement')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="safety">Safety Awareness Training Date<span class="text-danger"> </span></label>
                                <input type="text" id="date" class="form-control flatpickr flatpickr-input active" wire:model.defer="safety" placeholder="Safety Awareness Training Date">
                                @error('safety')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-8 mb-4">
                                <label for="proof_training">Training Topic<span class="text-danger"> </span></label>
                                <input type="text" class="form-control"  wire:model.defer="proof_training" placeholder="Proof of Training">
                                @error('proof_training')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6" wire:loading.remove wire:target="proof">
                                <div class="form-group custom-file-container" data-upload-id="myFirstImage" wire:ignore>
                                    <label>Proof of Training (Attach image) <a href="#" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file" >
                                        <input type="file" class=" form-control" wire:model.defer="proof"  multiple>
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                                @error('proof.*')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mt-4" wire:loading wire:target="proof">
                                <br><br><br><br>
                                @include('spinner.uploading-images')
                            </div>
                            <div class="form-group col-md-6" wire:loading.remove wire:target="inc_img">
                                <div class="form-group custom-file-container" data-upload-id="mySecondImage" wire:ignore>
                                    <label>Incident Images (Attach image) <a href="#" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file" >
                                        <input type="file" class=" form-control" wire:model.defer="inc_img"  multiple>
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                                @error('inc_img.*')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mt-4" wire:loading wire:target="inc_img">
                                <br><br><br><br>
                                @include('spinner.uploading-images')
                            </div>
                            <div class="form-group col-md-12" wire:loading wire:target="docs">
                                @include('spinner.uploading-documents')
                            </div>
                            <div class="form-group col-md-12 mt-2" wire:loading.remove wire:target="docs">
                                <label for="docs">Attached Documents (word/pdf)<span class="text-danger"> </span></label>
                                <input type="file" class="form-control-file"  wire:model.defer="docs">
                                @error('docs')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer mt-4">
                            {{-- <div wire:loading wire:target="create" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Processing . . .</div> --}}

                            <div wire:loading.remove wire:target="proof, inc_img, docs">
                                <button  class="btn btn-dark waves-effect waves-light" type="submit">Submit</button>
                                <a href="{{ session()->has('previousRoute') ? url(session()->get('previousRoute')) : url()->previous() }}" type="button" class="btn btn-danger waves-effect">Cancel</a>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>

    </div>

</div>


@push('create-notifications-js')
<script src="{{ asset('assets/file-upload/file-upload-with-preview.min.js') }}"></script>
<script src="{{ asset('assets/flatpickr/flatpickr.js') }}"></script>
<script>
    var secondUpload = new FileUploadWithPreview('myFirstImage')
    var secondUpload = new FileUploadWithPreview('mySecondImage')
</script>
<script>
    var f2 = flatpickr(document.getElementById('date'), {
        enableTime: false,
        dateFormat: "Y-m-d",
    });
</script>
<script>
    $(document).ready(function () {
        window.addEventListener('reApplySelect2', event => {
            $('#mgr_name').select2();
            $('#sup_name').select2();
            $('#aider').select2();
        });
    });
</script>
<script>
    $('form').submit(function() {
        @this.set('mgr_name', $('#mgr_name').val());
        @this.set('sup_name', $('#sup_name').val());
        @this.set('aider', $('#aider').val());
    })
</script>


@endpush
