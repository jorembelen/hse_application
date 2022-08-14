<?php

namespace App\Http\Livewire\Incident;

use App\Models\Incident;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class IncidentDetails extends Component
{
    public $incidentId;
    public $listeners = [
        'delete'
    ];

    public function mount($incidentId)
    {
        $this->incidentId = $incidentId;
    }

    public function render()
    {
        $incidents = Incident::find($this->incidentId);

        $employees = $incidents->employee->badge .' - '. $incidents->employee->name .''.($incidents->employee->designation);

        $photos = explode('|', $incidents->images);

        return view('livewire.incident.incident-details', compact('incidents', 'employees', 'photos'))->extends('layouts.master');
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

    public function delete(Incident $incident)
    {
        DB::beginTransaction();
        if($incident) {
            $incident->delete();
            // Remove old images
            $photos = explode("|", $incident->images);
            if(count($photos) > 0){
                //  dd($photos);
                foreach($photos as $photo){
                    $path1 = 'files/image/';
                    $path2 = 'files/thumbnail/';
                    // Delete old image from file
                    Storage::disk('local')->delete(parse_url($path1 .$photo));
                    Storage::disk('local')->delete(parse_url($path2 .$photo));
                }
            }

            DB::commit();

            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Success, Incident was successfully deleted!.',
                'text' => '',
            ]);
            return redirect()->route('admin.incidents');
        }else{
            DB::rollBack();
            return redirect()->back();
        }
    }

}
