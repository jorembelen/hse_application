<?php

namespace App\Http\Livewire\Admin;

use App\Models\Employee;
use App\Models\Incident;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateIncidentNotifications extends Component
{
    use WithFileUploads;
    public $employee_id, $location, $type, $inc_category, $insurance, $sel_involved, $contractor, $injury_location;
    public $involved, $injury_sustain, $cause, $equipment, $description, $action, $wps, $severity, $date, $docs;
    public $images = [];
    public $hasImages = 0;
    public $hasDocs = 0;

    public $listeners = [
        'classChanged'
    ];

    public function classChanged($value, $loc, $inv, $inj, $injs, $cause, $equipment)
    {
        $this->employee_id = $value;
        $this->location = $loc;
        $this->involved = $inv;
        $this->injury_location = $inj;
        $this->injury_sustain = $injs;
        $this->cause = $cause;
        $this->equipment = $equipment;
    }

    public function mount()
    {
        $this->dispatchBrowserEvent('reApplySelect2');
        session()->put('previousRoute', url()->previous());
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


        return view('livewire.admin.create-incident-notifications', compact('officers', 'locations'))->extends('layouts.master');
    }

    public function create()
    {
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


        $incidents = new Incident();
        DB::beginTransaction();
        if($data) {
            $data['user_id'] = auth()->id();
            $data['hasImages'] = $this->hasImages;
            $data['hasDocs'] = $this->hasDocs;
            $incidents->addIncident($data);

            DB::commit();

            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Success, Incident was successfully created!.',
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

    public function removeMe($index)
    {
        array_splice($this->images, $index, 1);
        $this->dispatchBrowserEvent('reApplySelect2');
    }

}
