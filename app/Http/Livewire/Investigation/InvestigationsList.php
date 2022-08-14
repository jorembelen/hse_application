<?php

namespace App\Http\Livewire\Investigation;

use App\Models\Report;
use Livewire\Component;

class InvestigationsList extends Component
{
    public function render()
    {
        $reports = Report::query()->latest()->get();

        return view('livewire.investigation.investigations-list', compact('reports'))->extends('layouts.master');
    }
}
