<?php

namespace App\Http\Livewire\Project;

use App\Models\RootCause;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectRecommendations extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $query, $causeId, $root_name, $type, $rec_name, $rec_type, $status;
    protected $queryString = ['query'];

    public function updated($property)
    {
        if ($property === 'query') {
            $this->resetPage();
        }
    }

    public function render()
    {
        $cause = RootCause::search($this->query)
            ->whereHas('report', function($q){
                $q->where('location_id', auth()->user()->location_id);
            })
            ->latest()->paginate(10);
        session()->put('previousRoute', url()->previous());

        return view('livewire.project.project-recommendations', compact('cause'))->extends('layouts.master');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('hide-modal');
        $this->resetValidation();
        $this->root_name = null;
        $this->type = null;
        $this->rec_name = null;
        $this->rec_type = null;
        $this->status = null;
    }

    public function showEdit(RootCause $cause)
    {
        $this->dispatchBrowserEvent('show-modal');
        $this->causeId = $cause->id;
        $this->root_name = $cause->root_name;
        $this->type = $cause->type;
        $this->rec_name = $cause->rec_name;
        $this->rec_type = $cause->rec_type;
        $this->status = $cause->status;
    }

    public function submit(RootCause $cause)
    {
        $data = $this->validate([
            'root_name' => 'required',
            'type' => 'required',
            'rec_name' => 'required',
            'rec_type' => 'required',
            'status' => 'required',
        ], [
            'root_name.required' => 'Root cause field is required.',
            'rec_name.required' => 'Recommendation field is required.',
            'rec_type.required' => 'Type field is required.',
        ]);

        DB::beginTransaction();
        if($data) {
            $cause->update($data);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Data was successfully updated.',
                'text' => '',
            ]);

            $this->close();
            return;
        }else{
            DB::rollBack();
        }
    }

}
