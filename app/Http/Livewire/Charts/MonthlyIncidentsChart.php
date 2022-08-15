<?php

namespace App\Http\Livewire\Charts;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MonthlyIncidentsChart extends Component
{
    public function render()
    {

        $thisYear = Carbon::create(date('Y'))->format('Y');
        $lastYear = Carbon::create(date('Y')-1)->format('Y');

        $previousYear = [];
        $incidents = DB::table('incidents')->select(DB::raw("COUNT(*) as count"))
        ->whereYear('date', $lastYear)
        ->groupBy(DB::raw("Month(date)"))
        ->pluck('count');

        $months = DB::table('incidents')->select(DB::raw("Month(date) as month"))
        ->whereYear('date', $lastYear)
        ->groupBy(DB::raw("Month(date)"))
        ->pluck('month');
        $previousYear = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $previousYear[$month -1 ] = $incidents[$index];
        }

        $currentYear = [];
        $incidents = DB::table('incidents')->select(DB::raw("COUNT(*) as count"))
        ->whereYear('date', $thisYear)
        ->groupBy(DB::raw("Month(date)"))
        ->pluck('count');

        $months = DB::table('incidents')->select(DB::raw("Month(date) as month"))
        ->whereYear('date', $thisYear)
        ->groupBy(DB::raw("Month(date)"))
        ->pluck('month');
        $currentYear = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $currentYear[$month -1 ] = $incidents[$index];
        }



        return view('livewire.charts.monthly-incidents-chart', compact('lastYear', 'thisYear', 'previousYear', 'currentYear'));
    }
}
