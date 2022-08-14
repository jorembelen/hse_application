<?php

namespace App\Http\Livewire\Investigation;

use App\Models\Employee;
use App\Models\Location;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class InvestigationEdit extends Component
{
    use WithFileUploads;
    public $reportId, $mgr_name, $sup_name, $inc_loc, $nature, $other, $description, $details, $aid, $aider, $hosp, $hospital, $hos_addr;
    public $med_leave, $leave_days, $prop_dam, $est_dam, $est_amt, $property, $prop_loc, $prop_manuf, $prop_model, $prop_plate, $prop_reg, $prop_rte;
    public $toolbox, $ppe, $ppe_equip, $emp_doing, $emp_machine, $emp_material, $imm_cause, $witness, $wit_type, $wit_details, $wit_statement;
    public $root_name, $root_description, $rec_name, $rec_type, $safety, $proof_training, $docs, $oldProof, $oldImages;
    public $proof = [];
    public $inc_img = [];
    public $inputs = [];
    public $hasProof = 0;
    public $hasImages = 0;
    public $hasDocs = 0;

    public function render()
    {
        $officers = Employee::query()
        ->get();
        if(in_array(auth()->user()->role, ['user', 'site_member'])){
            $locations = Location::whereid(auth()->user()->locations->id)->get();
        }else{
            $locations = Location::query()
                ->get();
        }

        return view('livewire.investigation.investigation-edit', compact('officers', 'locations'))->extends('layouts.master');
    }

    public function mount(Report $investigation)
    {
        session()->put('previousRoute', url()->previous());
        $this->reportId = $investigation->id;
        $this->mgr_name = $investigation->mgr_name;
        $this->sup_name = $investigation->sup_name;
        $this->inc_loc = $investigation->inc_loc;
        $this->nature = $investigation->nature;
        $this->other = $investigation->other;
        $this->description = $investigation->description;
        $this->details = $investigation->details;
        $this->aid = $investigation->aid;
        $this->aider = $investigation->aider;
        $this->hosp = $investigation->hosp;
        $this->hospital = $investigation->hospital;
        $this->hos_addr = $investigation->hos_addr;
        $this->med_leave = $investigation->med_leave;
        $this->leave_days = $investigation->leave_days;
        $this->prop_dam = $investigation->prop_dam;
        $this->est_dam = $investigation->est_dam;
        $this->est_amt = $investigation->est_amt;
        $this->property = $investigation->property;
        $this->prop_loc = $investigation->prop_loc;
        $this->prop_manuf = $investigation->prop_manuf;
        $this->prop_model = $investigation->prop_model;
        $this->prop_plate = $investigation->prop_plate;
        $this->prop_reg = $investigation->prop_reg;
        $this->prop_rte = $investigation->prop_rte;
        $this->toolbox = $investigation->toolbox;
        $this->ppe = $investigation->ppe;
        $this->ppe_equip = $investigation->ppe_equip;
        $this->emp_doing = $investigation->emp_doing;
        $this->emp_machine = $investigation->emp_machine;
        $this->emp_material = $investigation->emp_material;
        $this->imm_cause = $investigation->imm_cause;
        $this->witness = $investigation->witness;
        $this->wit_type = $investigation->wit_type;
        $this->wit_details = $investigation->wit_details;
        $this->wit_statement = $investigation->wit_statement;
        $this->root_name = $investigation->root_name;
        $this->root_description = $investigation->root_description;
        $this->rec_name = $investigation->rec_name;
        $this->rec_type = $investigation->rec_type;
        $this->safety = $investigation->safety ? $investigation->safety->format('Y-m-d') : null;
        $this->proof_training = $investigation->proof_training;
        $this->oldProof = explode('|', $investigation->proof);
        $this->oldImages = explode('|', $investigation->inc_img);
        // $this->docs = $investigation->docs;
    }

    public function update(Report $investigation)
    {
        $data = $this->validate([
            'mgr_name' => 'required|max:255',
            'sup_name' => 'required|max:255',
            'inc_loc' => 'required|max:255',
            'nature' => 'required|max:255',
            'other' => 'required|max:255',
            'description' => 'required|max:255',
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
            $data['id'] = $investigation->id;
            $data['user_id'] = auth()->id();
            $data['hasProof'] = $this->hasProof;
            $data['hasImages'] = $this->hasImages;
            $data['hasDocs'] = $this->hasDocs;
            $data['incident_id'] = $investigation->incident_id;
            $data['employee_id'] = $investigation->employee_id;
            $data['location_id'] = $investigation->location_id;
            $data['aider'] = $this->aider ? $this->aider : null;

            $report->editInvestigation($data);

            DB::commit();

            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Success, Investigation was successfully updated!.',
                'text' => '',
            ]);
            return redirect()->route('admin.investigation');
        }else{
            DB::rollBack();
            return redirect()->back();
        }
    }


}
