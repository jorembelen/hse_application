<?php

namespace App\Http\Livewire\Project;

use App\Models\Report;
use Livewire\Component;

class ProjectInvestigations extends Component
{
    public function render()
    {
        $reports = Report::query()
            ->wherelocation_id(auth()->user()->location_id)
            ->latest()->get();

        return view('livewire.project.investigations', compact('reports'))->extends('layouts.master');
    }
}
