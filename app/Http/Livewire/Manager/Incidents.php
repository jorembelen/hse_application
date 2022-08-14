<?php

namespace App\Http\Livewire\Manager;

use App\Models\Incident;
use Livewire\Component;

class Incidents extends Component
{
    public function render()
    {
        $incidents = Incident::query()->latest()->get();

        return view('livewire.manager.incidents', compact('incidents'))->extends('layouts.master');
    }
}
