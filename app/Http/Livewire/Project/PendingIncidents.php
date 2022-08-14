<?php

namespace App\Http\Livewire\Project;

use App\Models\Incident;
use Livewire\Component;

class PendingIncidents extends Component
{
    public function render()
    {
        $incidents = Incident::query()
        ->wherestatus(0)
        ->with(['officer', 'employee'])
        ->wherelocation(auth()->user()->location_id)
        ->latest()->get();

        return view('livewire.project.pending-incidents', compact('incidents'))->extends('layouts.master');
    }
}
