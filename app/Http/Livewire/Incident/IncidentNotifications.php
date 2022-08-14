<?php

namespace App\Http\Livewire\Incident;

use App\Models\Incident;
use Livewire\Component;

class IncidentNotifications extends Component
{

    public function render()
    {
        $incidents = Incident::query()->latest()->get();

        return view('livewire.incident.incident-notifications', compact('incidents'))->extends('layouts.master');
    }




}
