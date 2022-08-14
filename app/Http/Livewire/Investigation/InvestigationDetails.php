<?php

namespace App\Http\Livewire\Investigation;

use App\Models\Incident;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class InvestigationDetails extends Component
{
    public $reportId;
    public $listeners = [
        'delete'
    ];

    public function mount($reportId)
    {
        $this->reportId = $reportId;
        session()->put('previousRoute', url()->previous());
    }

    public function render()
    {
        $report = Report::whereincident_id($this->reportId)->first();
        $output = $report->name();

        $photos = explode('|', $report->proof);
        $images = explode('|', $report->inc_img);

        return view('livewire.investigation.investigation-details', compact('report', 'photos', 'images', 'output'))->extends('layouts.master');
    }

    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'message' => 'Are you sure?',
            'text' => 'Are you sure? Please confirm to proceed.',
            'id' => $id
        ]);
    }

    public function delete(Report $report)
    {
        DB::beginTransaction();
        if($report) {
            // Delete old image from file
            if($report->docs) {
                $path = 'files/documents/';
                Storage::disk('local')->delete(parse_url($path .$report->docs));
            }

            $photos1 = explode('|', $report->proof);
            $photos2 = explode('|', $report->inc_img);

            if($report->proof) {
                foreach($photos1 as $proof){
                    $path1 = 'files/image/';
                    $path2 = 'files/thumbnail/';
                    // Delete old image from file
                    Storage::disk('local')->delete(parse_url($path1 .$proof));
                    Storage::disk('local')->delete(parse_url($path2 .$proof));
                }
            }
            if($report->inc_img) {
                foreach($photos2 as $image){
                    $path3 = 'files/image/';
                    $path4 = 'files/thumbnail/';
                    // Delete old image from file
                    Storage::disk('local')->delete(parse_url($path3 .$image));
                    Storage::disk('local')->delete(parse_url($path4 .$image));
                }
            }

            Incident::find($report->incident_id)->update(['status' => 0]);

            $report->rootcause()->delete();
            // $report->remark()->delete();
            $report->delete();

            DB::commit();

            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Success, Incident was successfully deleted!.',
                'text' => '',
            ]);
            if(auth()->user()->role == 'user' || auth()->user()->role == 'site_member'){
                return redirect()->route('project.investigation');
            }
            return redirect()->route('admin.investigation');
        }else{
            DB::rollBack();
            return redirect()->back();
        }
    }

}
