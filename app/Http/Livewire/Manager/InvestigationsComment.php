<?php

namespace App\Http\Livewire\Manager;

use App\Models\Report;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InvestigationsComment extends Component
{
    public $reportId, $status, $note;

    public function mount($reportId)
    {
        $this->reportId = $reportId;
        session()->put('previousRoute', url()->previous());
    }

    public function render()
    {
        $report = Report::find($this->reportId);
        $output = $report->name();

        $photos = explode('|', $report->proof);
        $images = explode('|', $report->inc_img);

        return view('livewire.manager.investigations-comment', compact('report', 'photos', 'images', 'output'))->extends('layouts.master');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('hide-modal');
        $this->resetValidation();
        $this->status = null;
        $this->note = null;
    }

    public function comment()
    {
        $this->dispatchBrowserEvent('show-modal');
    }

    public function submit(Report $report)
    {
        $data = $this->validate([
            'status' => 'required',
            'note' => 'required',
        ]);

        DB::beginTransaction();
        if($data) {
            $data['incident_id'] = $report->incident_id;
            $data['user_id'] = auth()->id();
            $report->remark()->create($data);
            $report->update(['remarks' => 1]);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Remarks was successfully added.',
                'text' => '',
            ]);

            $this->close();
            return;
        }else{
            DB::rollBack();
        }

    }

}
