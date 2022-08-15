<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Report;
use \PDF;

class InvestigationPrintController extends Controller
{
    public function printIncident(Incident $incident)
    {
        $photos = explode('|', $incident->images);

        $pdf = PDF::loadView('print.incidents',compact('incident', 'photos'));
        return $pdf->stream('reports.pdf');
    }

    public function printReporDetails($id)
    {
        $reports = Report::findOrFail($id);

        $output = $reports->name();

        $photos = explode('|', $reports->proof);
        $images = explode('|', $reports->inc_img);

        $pdf = PDF::loadView('print.reports',compact('reports', 'output', 'images', 'photos'));
        return $pdf->stream('reports.pdf');

    }

}
