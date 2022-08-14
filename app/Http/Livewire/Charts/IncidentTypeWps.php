<?php

namespace App\Http\Livewire\Charts;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class IncidentTypeWps extends Component
{
    public function render()
    {
        $lostTimeInjury3 = count(DB::table('incidents')->wheretype('lost time injury')->wherewps('3')->pluck('id'));
        $lostTimeInjury4 = count(DB::table('incidents')->wheretype('lost time injury')->wherewps('4')->pluck('id'));
        $lostTimeInjury5 = count(DB::table('incidents')->wheretype('lost time injury')->wherewps('5')->pluck('id'));

        $lostTimeInjury = [$lostTimeInjury3, $lostTimeInjury4, $lostTimeInjury5];

        $dangerousOccurence3 = count(DB::table('incidents')->wheretype('dangerous occurence')->wherewps('3')->pluck('id'));
        $dangerousOccurence4 = count(DB::table('incidents')->wheretype('dangerous occurence')->wherewps('4')->pluck('id'));
        $dangerousOccurence5 = count(DB::table('incidents')->wheretype('dangerous occurence')->wherewps('5')->pluck('id'));

        $dangerousOccurence = [$dangerousOccurence3, $dangerousOccurence4, $dangerousOccurence5];

        $root1 = count(DB::table('root_causes')->wheretype('people')->pluck('id'));
        $root2 = count(DB::table('root_causes')->wheretype('process')->pluck('id'));
        $root3 = count(DB::table('root_causes')->wheretype('equipment')->pluck('id'));
        $root4 = count(DB::table('root_causes')->wheretype('workplace')->pluck('id'));

        $cause =[$root1, $root2, $root3, $root4];

        $fatality3 = count(DB::table('incidents')->wheretype('fatality')->wherewps('3')->pluck('id'));
        $fatality4 = count(DB::table('incidents')->wheretype('fatality')->wherewps('4')->pluck('id'));
        $fatality5 = count(DB::table('incidents')->wheretype('fatality')->wherewps('5')->pluck('id'));

        $fatality = [$fatality3, $fatality4, $fatality5];

        $firstAid3 = count(DB::table('incidents')->wheretype('first aid')->wherewps('3')->pluck('id'));
        $firstAid4 = count(DB::table('incidents')->wheretype('first aid')->wherewps('4')->pluck('id'));
        $firstAid5 = count(DB::table('incidents')->wheretype('first aid')->wherewps('5')->pluck('id'));

        $firstAid = [$firstAid3, $firstAid4, $firstAid5];

        $propertyDamage3 = count(DB::table('incidents')->wheretype('property damage')->wherewps('3')->pluck('id'));
        $propertyDamage4 = count(DB::table('incidents')->wheretype('property damage')->wherewps('4')->pluck('id'));
        $propertyDamage5 = count(DB::table('incidents')->wheretype('property damage')->wherewps('5')->pluck('id'));

        $propertyDamage = [$propertyDamage3, $propertyDamage4, $propertyDamage5];

        $mtc3 = count(DB::table('incidents')->wheretype('mtc')->wherewps('3')->pluck('id'));
        $mtc4 = count(DB::table('incidents')->wheretype('mtc')->wherewps('4')->pluck('id'));
        $mtc5 = count(DB::table('incidents')->wheretype('mtc')->wherewps('5')->pluck('id'));

        $mtc = [$mtc3, $mtc4, $mtc5];

        $rwc3 = count(DB::table('incidents')->wheretype('rwc')->wherewps('3')->pluck('id'));
        $rwc4 = count(DB::table('incidents')->wheretype('rwc')->wherewps('4')->pluck('id'));
        $rwc5 = count(DB::table('incidents')->wheretype('rwc')->wherewps('5')->pluck('id'));

        $rwc = [$rwc3, $rwc4, $rwc5];

        $mvi3 = count(DB::table('incidents')->wheretype('mvi')->wherewps('3')->pluck('id'));
        $mvi4 = count(DB::table('incidents')->wheretype('mvi')->wherewps('4')->pluck('id'));
        $mvi5 = count(DB::table('incidents')->wheretype('mvi')->wherewps('5')->pluck('id'));

        $mvi = [$mvi3, $mvi4, $mvi5];

        $nearMiss3 = count(DB::table('incidents')->wheretype('near miss')->wherewps('3')->pluck('id'));
        $nearMiss4 = count(DB::table('incidents')->wheretype('near miss')->wherewps('4')->pluck('id'));
        $nearMiss5 = count(DB::table('incidents')->wheretype('near miss')->wherewps('5')->pluck('id'));

        $nearMiss = [$nearMiss3, $nearMiss4, $nearMiss5];

        return view('livewire.charts.incident-type-wps', compact(
            'lostTimeInjury', 'dangerousOccurence', 'cause', 'fatality', 'firstAid', 'propertyDamage',
            'mtc', 'mvi', 'nearMiss', 'rwc'
        ));
    }
}
