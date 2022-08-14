<?php

namespace App\Http\Livewire\Incident;

use App\Models\Incident;
use Livewire\Component;

class PendingIncidents extends Component
{
    public function render()
    {
        $incidents = Incident::query()
            ->with(['officer', 'employee'])
            ->wherestatus(0)
            ->latest()->get();

        return view('livewire.incident.pending-incidents', compact('incidents'))->extends('layouts.master');
    }
}
