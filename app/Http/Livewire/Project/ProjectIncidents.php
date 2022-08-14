<?php

namespace App\Http\Livewire\Project;

use App\Models\Incident;
use Livewire\Component;

class ProjectIncidents extends Component
{
    public function render()
    {
        $incidents = Incident::query()
        ->wherelocation(auth()->user()->location_id)
        ->latest()->get();

        return view('livewire.project.incidents-component', compact('incidents'))->extends('layouts.master');
    }
}
