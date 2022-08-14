<?php

namespace App\Http\Livewire\Incident;

use App\Models\Employee;
use App\Models\Incident;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class IncidentEdit extends Component
{
    use WithFileUploads;
    public $employee_id, $location, $type, $inc_category, $insurance, $sel_involved, $contractor, $injury_location, $oldImages;
    public $involved, $injury_sustain, $cause, $equipment, $description, $action, $wps, $severity, $date, $docs, $incidentId;
    public $images = [];
    public $hasImages = 0;
    public $hasDocs = 0;

    public function mount(Incident $incident)
    {
        session()->put('previousRoute', url()->previous());
        $this->incidentId = $incident->id;
        $this->employee_id = $incident->employee_id;
        $this->location = $incident->location;
        $this->type = $incident->type;
        $this->inc_category = $incident->inc_category;
        $this->insurance = $incident->insurance;
        $this->sel_involved = $incident->sel_involved;
        $this->contractor = $incident->contractor;
        $this->injury_location = explode(",", $incident->injury_location);
        // dd($this->injury_location);
        $this->involved = $incident->involved;
        $this->injury_sustain = $incident->injury_sustain;
        $this->cause = $incident->cause;
        $this->equipment = $incident->equipment;
        $this->description = $incident->description;
        $this->action = $incident->action;
        $this->wps = $incident->wps;
        $this->severity = $incident->severity;
        $this->date = $incident->date;
        $this->oldImages = explode("|", $incident->images);
    }

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

        return view('livewire.incident.incident-edit', compact('officers', 'locations'))->extends('layouts.master');
    }

    public function update(Incident $incident)
    {
        // dd($this->involved);
        $data = $this->validate([
            'employee_id' => 'required|max:255',
            'location' => 'required|max:255',
            'type' => 'required|max:255',
            'inc_category' => 'required|max:255',
            'insurance' => 'required|max:255',
            'sel_involved' => 'required|max:255',
            'injury_location' => 'required|max:255',
            'injury_sustain' => 'required|max:255',
            'involved' => 'required_if:sel_involved,Employee',
            'contractor' => 'required_if:sel_involved,NonEmployee',
            'cause' => 'required|max:255',
            'equipment' => 'required|max:255',
            'description' => 'required|max:255',
            'action' => 'required|max:255',
            'wps' => 'required|max:255',
            'severity' => 'required|max:255',
            'date' => 'required',
            'images.*' => 'nullable|image',
            'docs' => 'nullable|mimes:doc,docx,pdf|max:2048',
        ],[
            'employee_id.required' => 'Please choose employee.',
            'location.required' => 'Please choose location.',
            'type.required' => 'Please choose type of incident.',
            'inc_category.required' => 'Please choose incident category.',
            'insurance.required' => 'Please choose insurance type.',
            'injury_location.required' => 'Please choose injury location.',
            'sel_involved.required' => 'Please choose type of persons involved.',
            'involved.required_if' => 'Please choose employees involved.',
            'contractor.required_if' => 'Please add contractors name involved.',
            'injury_sustain.required' => 'Please choose injury sustain.',
            'cause.required' => 'Please choose immediate cause.',
            'equipment.required' => 'Please choose equipment involved.',
            'images.*.image' => 'Please attach only image.',
            'docs.mimes' => 'Please attach only file types: doc, docx, pdf.',
        ]);
        if($this->images){
            $this->hasImages = 1;
        }
        if($this->docs){
            $this->hasDocs = 1;
        }

        DB::beginTransaction();
        if($data) {
            $data['id'] = $incident->id;
            $data['hasImages'] = $this->hasImages;
            $data['hasDocs'] = $this->hasDocs;
            $data['user_id'] = auth()->id();
            $incident->editIncident($data);

            DB::commit();

            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Success, Incident was successfully updated!.',
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

}
