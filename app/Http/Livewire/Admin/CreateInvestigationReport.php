<?php

namespace App\Http\Livewire\Admin;

use App\Models\Employee;
use App\Models\Incident;
use App\Models\Location;
use App\Models\Report;
use App\Models\RootCause;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class CreateInvestigationReport extends Component
{
    use WithFileUploads;
    public $incidentId, $mgr_name, $sup_name, $inc_loc, $nature, $other, $description, $details, $aid, $aider, $hosp, $hospital, $hos_addr;
    public $med_leave, $leave_days, $prop_dam, $est_dam, $est_amt, $property, $prop_loc, $prop_manuf, $prop_model, $prop_plate, $prop_reg, $prop_rte;
    public $toolbox, $ppe, $ppe_equip, $emp_doing, $emp_machine, $emp_material, $imm_cause, $witness, $wit_type, $wit_details, $wit_statement;
    public $root_name, $root_description, $rec_name, $rec_type, $safety, $proof_training, $docs;
    public $proof = [];
    public $inc_img = [];
    public $inputs = [];
    public $hasProof = 0;
    public $hasImages = 0;
    public $hasDocs = 0;
    public $i = 1;

    public function add($i)

    {
        $i = $i + 1;

        $this->i = $i;

        array_push($this->inputs ,$i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function addCat($b)

    {
        $b = $b + 1;

        $this->b = $b;

    }

    public function removeCat($b)
    {
        $b = $b - 1;

        $this->b = $b;

    }

    public $listeners = [
        'classChanged'
    ];

    public function classChanged($value, $sup, $aider)
    {
        $this->mgr_name = $value;
        $this->sup_name = $sup;
        $this->aider = $aider;
    }

    public function mount($incidentId)
    {
        $this->incidentId = $incidentId;
        session()->put('previousRoute', url()->previous());
    }

    public function render()
    {
        $incident = Incident::find($this->incidentId);

        $officers = Employee::query()->get();
        $locations = Location::query()->get();

        return view('livewire.admin.create-investigation-report', compact('incident', 'officers', 'locations'))->extends('layouts.master');
    }


    public function create(Incident $incident)
    {
        $data = $this->validate([
            'mgr_name' => 'required|max:255',
            'sup_name' => 'required|max:255',
            'inc_loc' => 'required|max:255',
            'nature' => 'required|max:255',
            'other' => 'required|max:255',
            'description' => 'required',
            'details' => 'required|max:255',
            'aid' => 'required|max:255',
            'aider' => 'required_if:aid,Yes',
            'hosp' => 'required|max:255',
            'hospital' => 'required_if:hosp,Yes|max:255',
            'hos_addr' => 'required_if:hosp,Yes|max:255',
            'med_leave' => 'required|max:255',
            'leave_days' => 'required_if:med_leave,Yes|max:255',
            'prop_dam' => 'required|max:255',
            'est_dam' => 'nullable|max:255',
            'est_amt' => 'nullable|max:255',
            'property' => 'nullable|max:255',
            'prop_loc' => 'nullable|max:255',
            'prop_manuf' => 'nullable|max:255',
            'prop_model' => 'nullable|max:255',
            'prop_plate' => 'nullable|max:255',
            'prop_reg' => 'nullable|max:255',
            'prop_rte' => 'nullable|max:255',
            'toolbox' => 'required|max:255',
            'ppe' => 'required|max:255',
            'ppe_equip' => 'required_if:ppe,Yes|max:255',
            'emp_doing' => 'required|max:255',
            'emp_machine' => 'required|max:255',
            'emp_material' => 'required|max:255',
            'imm_cause' => 'required|max:255',
            'root_name' => 'required|max:255',
            'root_description' => 'required|max:255',
            'rec_name' => 'required|max:255',
            'rec_type' => 'required|max:255',
            'witness' => 'required|max:255',
            'wit_type' => 'required_if:witness,Yes|max:255',
            'wit_details' => 'required_if:witness,Yes|max:255',
            'wit_statement' => 'required_if:witness,Yes|max:255',
            'safety' => 'nullable|max:255',
            'proof_training' => 'nullable|max:255',
            'proof.*' => 'nullable|image',
            'inc_img.*' => 'nullable|image',
            'docs' => 'nullable|mimes:doc,docx,pdf|max:2048',
        ], [
            'mgr_name.required' => 'The line manager\'s name field is required.',
            'sup_name.required' => 'The supervisor\'s name field is required.',
            'inc_loc.required' => 'The incident location field is required.',
            'nature.required' => 'The nature of incident field is required.',
            'other.required' => 'Please add specify field.',
            'aid.required' => 'The first aid field is required.',
            'med_leave.required' => 'The medical leave field is required.',
            'prop_dam.required' => 'The property damage field is required.',
            'hosp.required' => 'The hospitalized field is required.',
            'toolbox.required' => 'The toolbox meeting field is required.',
            'emp_doing.required' => 'The employee doing field is required.',
            'emp_machine.required' => 'The machine doing field is required.',
            'emp_material.required' => 'The material doing field is required.',
            'imm_cause.required' => 'The immediate cause field is required.',
            'inc_img.required' => 'The incident image field is required.',
            'root_name.required' => 'The root cause description is required.',
            'root_description.required' => 'The root cause type is required.',
            'rec_name.required' => 'The recommendation is required.',
            'rec_type.required' => 'The recommendation type is required.',
            'aider.required_if' => 'Please select first aider.',
            'wit_type.required_if' => 'Choose witness type.',
            'ppe_equip.required_if' => 'Please specify the PPE used.',
            'wit_details.required_if' => 'Witness details are required.',
            'wit_statement.required_if' => 'Witness statement is required.',
            'hospital.required_if' => 'Hospital name is required.',
            'hos_addr.required_if' => 'Hospital address is required.',
            'leave_days.required_if' => 'Please enter number of days.',
            'proof.*.image' => 'Please attach only image.',
            'inc_img.*.image' => 'Please attach only image.',
            'docs.mimes' => 'Please attach only file types: doc, docx, pdf.',
        ]);

        if($this->proof){
            $this->hasProof = 1;
        }
        if($this->inc_img){
            $this->hasImages = 1;
        }
        if($this->docs){
            $this->hasDocs = 1;
        }

        $report = new Report();

        DB::beginTransaction();
        if($data) {
            $data['user_id'] = auth()->id();
            $data['hasProof'] = $this->hasProof;
            $data['hasImages'] = $this->hasImages;
            $data['hasDocs'] = $this->hasDocs;
            $data['incident_id'] = $incident->id;
            $data['employee_id'] = $incident->employee_id;
            $data['location_id'] = $incident->location;
            $data['aider'] = $this->aider ? $this->aider : null;

            $report->addInvestigation($data);
            $incident->update(['status' => 1]);

            DB::commit();

            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Success, Investigation was successfully created!.',
                'text' => '',
            ]);
            if(auth()->user()->role == 'user' || auth()->user()->role == 'site_member'){
                return redirect()->route('project.incidents');
            }
            return redirect()->route('admin.incidents');
        }else{
            DB::rollBack();
            return redirect()->back();
        }
    }


    public function removeImg($index)
    {
        array_splice($this->inc_img, $index, 1);
        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function removeProof($index)
    {
        array_splice($this->proof, $index, 1);
        $this->dispatchBrowserEvent('reApplySelect2');
    }

}
