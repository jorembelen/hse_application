<?php

namespace App\Http\Livewire\Reports;

use App\Models\Incident;
use App\Models\Location;
use Carbon\Carbon;
use Livewire\Component;

class NotificationsReport extends Component
{
    public $result = false;
    public $type, $start_date, $end_date, $status, $location;
    public $incidents = [];

    public function render()
    {
        $incId = Incident::select('location')->distinct('location')->get()->toArray();
        $locations = Location::select('id', 'name')->whereIn('id', $incId)->orderBy('name', 'ASC')->get();

        return view('livewire.reports.notifications-report', compact('locations'))->extends('layouts.master');
    }

    public function filter()
    {
        $this->validate([
            'start_date' => 'required',
            'end_date' => 'required_with:start_date',
        ],[
            'end_date.required_with' => 'End date is required.',
        ]);


        $startDate = Carbon::createFromFormat('Y-m-d', $this->start_date)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $this->end_date)->endOfDay();

        $incidents = new Incident();

        if($this->type) {
            $incidents =  $incidents->wheretype($this->type);
        }

        if($this->status) {
            $incidents =  $incidents->wherestatus($this->status);
        }

        if($this->location) {
            $incidents =  $incidents->wherelocation($this->location);
        }

        if($this->start_date) {
            $incidents = $incidents->whereBetween('date',  [$startDate, $endDate]);
        }

        if($this->end_date < $this->start_date){
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'End date should be greater than Start date!',
                'text' => '',
            ]);
            $this->dispatchBrowserEvent('reApplySelect2');
            return back();
        }

        $this->incidents = $incidents->latest()->get();

        $this->result = true;
        $this->dispatchBrowserEvent('refreshComponent', ['componentName' => '#export-buttons']);

    }

    public function refresh()
    {
        $this->type = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->status = null;
        $this->incidents = null;
        $this->location = null;
        $this->result = false;
        $this->dispatchBrowserEvent('reApplySelect2');
        $this->dispatchBrowserEvent('refreshDate', ['componentDate' => '#datepicker']);
        $this->dispatchBrowserEvent('refreshDate', ['componentDate' => '#datepicker2']);
    }

}
