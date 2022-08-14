<?php

namespace App\Http\Livewire\Project;

use App\Models\Incident;
use App\Models\RootCause;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $awaiting =  count(Incident::wherestatus('0')->where('location', auth()->user()->location_id)->pluck('id'));
        $recommendation =  count(RootCause::wherestatus(0)
            ->whereHas('report', function($q){
                $q->where('location_id', auth()->user()->location_id);
            })
            ->pluck('id'));


        return view('livewire.project.dashboard', compact('awaiting', 'recommendation'));
    }
}
