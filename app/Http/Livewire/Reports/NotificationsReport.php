<?php

namespace App\Http\Livewire\Reports;

use App\Models\Incident;
use Livewire\Component;

class NotificationsReport extends Component
{
    public $result = false;
    public $type, $start_date, $end_date, $status;
    public $incidents = [];

    public function render()
    {

        return view('livewire.reports.notifications-report')->extends('layouts.master');
    }

    public function filter()
    {
        $this->validate([
            'start_date' => 'required',
            'end_date' => 'required_with:start_date',
        ],[
            'end_date.required_with' => 'End date is required.',
        ]);


        $incidents = new Incident();

        if($this->type) {
            $incidents =  $incidents->wheretype($this->type);
        }

        if($this->status) {
            $incidents =  $incidents->wherestatus($this->status);
            // dd($status);
        }

        if($this->start_date) {
            $incidents = $incidents->where('date', '>=', $this->start_date);
        }

        if($this->end_date) {
            $incidents = $incidents->where('date', '<=', $this->end_date);
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
        $this->result = false;
        $this->dispatchBrowserEvent('reApplySelect2');
        $this->dispatchBrowserEvent('refreshDate', ['componentDate' => '#datepicker']);
        $this->dispatchBrowserEvent('refreshDate', ['componentDate' => '#datepicker2']);
    }

}
