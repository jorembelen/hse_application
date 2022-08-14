<?php

namespace App\Http\Livewire\Investigation;

use App\Models\Report;
use Livewire\Component;

class Reviews extends Component
{
    public function render()
    {
        $reports = Report::query()
            ->whereHas('remark')
            ->latest()->get();

        return view('livewire.investigation.reviews', compact('reports'))->extends('layouts.master');
    }
}
