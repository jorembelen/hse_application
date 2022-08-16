<?php

namespace App\Http\Livewire\Charts;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MonthlyIncidentsTypeChart extends Component
{
    public $fatality, $lostInjury, $dangerousOccurence, $propertyDamage, $mtc, $rwc, $mvi, $nearMiss, $firstAid;

    public function render()
    {

        $this->fatality = [];
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
        $this->fatality = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $this->fatality[$month -1 ] = $incidents[$index];
        }

        $this->firstAid = [];
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
        $this->firstAid = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $this->firstAid[$month -1 ] = $incidents[$index];
        }

        $this->lostInjury = [];
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
        $this->lostInjury = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $this->lostInjury[$month -1 ] = $incidents[$index];
        }

        $this->dangerousOccurence = [];
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
        $this->dangerousOccurence = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $this->dangerousOccurence[$month -1 ] = $incidents[$index];
        }

        $this->propertyDamage = [];
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
        $this->propertyDamage = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $this->propertyDamage[$month -1 ] = $incidents[$index];
        }

        $this->mtc = [];
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
        $this->mtc = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $this->mtc[$month -1 ] = $incidents[$index];
        }

        $this->rwc = [];
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
        $this->rwc = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $this->rwc[$month -1 ] = $incidents[$index];
        }

        $this->mvi = [];
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
        $this->mvi = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $this->mvi[$month -1 ] = $incidents[$index];
        }

        $this->nearMiss = [];
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
        $this->nearMiss = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $this->nearMiss[$month -1 ] = $incidents[$index];
        }

        return view('livewire.charts.monthly-incidents-type-chart');
    }
}
