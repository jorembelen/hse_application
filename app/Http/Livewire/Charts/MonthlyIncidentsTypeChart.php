<?php

namespace App\Http\Livewire\Charts;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MonthlyIncidentsTypeChart extends Component
{
    public function render()
    {
        $fatality = [];
        $incidents = DB::table('incidents')->select(DB::raw("COUNT(*) as count"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->wheretype('Fatality')
        ->pluck('count');

        $months = DB::table('incidents')->select(DB::raw("Month(date) as month"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->wheretype('Fatality')
        ->pluck('month');
        $fatality = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $fatality[$month -1 ] = $incidents[$index];
        }

        $firstAid = [];
        $incidents = DB::table('incidents')->select(DB::raw("COUNT(*) as count"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->wheretype('First Aid')
        ->pluck('count');

        $months = DB::table('incidents')->select(DB::raw("Month(date) as month"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->wheretype('First Aid')
        ->pluck('month');
        $firstAid = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $firstAid[$month -1 ] = $incidents[$index];
        }

        $lostInjury = [];
        $incidents = DB::table('incidents')->select(DB::raw("COUNT(*) as count"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->wheretype('Lost Time Injury')
        ->pluck('count');

        $months = DB::table('incidents')->select(DB::raw("Month(date) as month"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->wheretype('Lost Time Injury')
        ->pluck('month');
        $lostInjury = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $lostInjury[$month -1 ] = $incidents[$index];
        }

        $dangerousOccurence = [];
        $incidents = DB::table('incidents')->select(DB::raw("COUNT(*) as count"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->wheretype('Dangerous Occurence')
        ->pluck('count');

        $months = DB::table('incidents')->select(DB::raw("Month(date) as month"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->wheretype('Dangerous Occurence')
        ->pluck('month');
        $dangerousOccurence = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $dangerousOccurence[$month -1 ] = $incidents[$index];
        }

        $propertyDamage = [];
        $incidents = DB::table('incidents')->select(DB::raw("COUNT(*) as count"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->wheretype('Property Damage')
        ->pluck('count');

        $months = DB::table('incidents')->select(DB::raw("Month(date) as month"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->wheretype('Property Damage')
        ->pluck('month');
        $propertyDamage = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $propertyDamage[$month -1 ] = $incidents[$index];
        }

        $mtc = [];
        $incidents = DB::table('incidents')->select(DB::raw("COUNT(*) as count"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->wheretype('MTC')
        ->pluck('count');

        $months = DB::table('incidents')->select(DB::raw("Month(date) as month"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->wheretype('MTC')
        ->pluck('month');
        $mtc = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $mtc[$month -1 ] = $incidents[$index];
        }

        $rwc = [];
        $incidents = DB::table('incidents')->select(DB::raw("COUNT(*) as count"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->wheretype('RWC')
        ->pluck('count');

        $months = DB::table('incidents')->select(DB::raw("Month(date) as month"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->wheretype('RWC')
        ->pluck('month');
        $rwc = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $rwc[$month -1 ] = $incidents[$index];
        }

        $mvi = [];
        $incidents = DB::table('incidents')->select(DB::raw("COUNT(*) as count"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->wheretype('MVI')
        ->pluck('count');

        $months = DB::table('incidents')->select(DB::raw("Month(date) as month"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->wheretype('MVI')
        ->pluck('month');
        $mvi = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $mvi[$month -1 ] = $incidents[$index];
        }

        $nearMiss = [];
        $incidents = DB::table('incidents')->select(DB::raw("COUNT(*) as count"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->wheretype('Near Miss')
        ->pluck('count');

        $months = DB::table('incidents')->select(DB::raw("Month(date) as month"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->wheretype('Near Miss')
        ->pluck('month');
        $nearMiss = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $nearMiss[$month -1 ] = $incidents[$index];
        }

        return view('livewire.charts.monthly-incidents-type-chart', compact('fatality', 'firstAid', 'lostInjury', 'dangerousOccurence', 'propertyDamage', 'mtc', 'rwc', 'mvi', 'nearMiss'));
    }
}
