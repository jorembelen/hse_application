<?php

namespace App\Http\Livewire\Manager;

use App\Models\Report;
use Livewire\Component;

class Investigations extends Component
{
    public function render()
    {
        $reports = Report::query()->latest()->get();

        return view('livewire.manager.investigations', compact('reports'))->extends('layouts.master');
    }
}
