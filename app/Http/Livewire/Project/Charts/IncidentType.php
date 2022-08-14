<?php

namespace App\Http\Livewire\Project\Charts;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class IncidentType extends Component
{
    public function render()
    {
        $totalA =  count(DB::table('incidents')->where('location', auth()->user()->location_id)->wheretype('Fatality')->pluck('id'));
        $totalB =  count(DB::table('incidents')->where('location', auth()->user()->location_id)->wheretype('Lost Time Injury')->pluck('id'));
        $totalC =  count(DB::table('incidents')->where('location', auth()->user()->location_id)->wheretype('Dangerous Occurence')->pluck('id'));
        $totalD =  count(DB::table('incidents')->where('location', auth()->user()->location_id)->wheretype('First Aid')->pluck('id'));
        $totalE =  count(DB::table('incidents')->where('location', auth()->user()->location_id)->wheretype('Property Damage')->pluck('id'));
        $totalF =  count(DB::table('incidents')->where('location', auth()->user()->location_id)->wheretype('MTC')->pluck('id'));
        $totalG =  count(DB::table('incidents')->where('location', auth()->user()->location_id)->wheretype('RWC')->pluck('id'));
        $totalH =  count(DB::table('incidents')->where('location', auth()->user()->location_id)->wheretype('MVI')->pluck('id'));
        $totalI =  count(DB::table('incidents')->where('location', auth()->user()->location_id)->wheretype('Near Miss')->pluck('id'));

        $data = [$totalA, $totalB, $totalC, $totalD, $totalE, $totalF, $totalG, $totalH, $totalI];

        return view('livewire.project.charts.incident-type', compact('data'));
    }
}
