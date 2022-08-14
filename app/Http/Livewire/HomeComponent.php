<?php

namespace App\Http\Livewire;

use App\Models\Incident;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $totalAwaiting =  count(Incident::wherestatus('0')->pluck('id'));

        return view('livewire.home-component', compact('totalAwaiting'))->extends('layouts.master');
    }
}
