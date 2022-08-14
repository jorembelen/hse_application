<?php

namespace App\Http\Livewire\Charts;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class IncidentType extends Component
{
    public function render()
    {
        $totalA =  count(DB::table('incidents')->wheretype('Fatality')->pluck('id'));
        $totalB =  count(DB::table('incidents')->wheretype('Lost Time Injury')->pluck('id'));
        $totalC =  count(DB::table('incidents')->wheretype('Dangerous Occurence')->pluck('id'));
        $totalD =  count(DB::table('incidents')->wheretype('First Aid')->pluck('id'));
        $totalE =  count(DB::table('incidents')->wheretype('Property Damage')->pluck('id'));
        $totalF =  count(DB::table('incidents')->wheretype('MTC')->pluck('id'));
        $totalG =  count(DB::table('incidents')->wheretype('RWC')->pluck('id'));
        $totalH =  count(DB::table('incidents')->wheretype('MVI')->pluck('id'));
        $totalI =  count(DB::table('incidents')->wheretype('Near Miss')->pluck('id'));

        $data = [$totalA, $totalB, $totalC, $totalD, $totalE, $totalF, $totalG, $totalH, $totalI];

        $pendingRecommendations =  count(DB::table('root_causes')->wherestatus('0')->pluck('id'));
        $pendingNotifications =  count(DB::table('incidents')->wherestatus('0')->pluck('id'));

        return view('livewire.charts.incident-type', compact('data', 'pendingRecommendations', 'pendingNotifications'));
    }
}
