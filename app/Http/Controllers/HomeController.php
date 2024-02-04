<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Report;
use \PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function print(Incident $incident)
    {
        $photos = explode('|', $incident->images);

        $pdf = PDF::loadView('print.incidents',compact('incident', 'photos'))->setOptions(['defaultFont' => 'poppins']);
        return $pdf->stream('reports.pdf');
    }

    public function printReport($id)
    {
        $reports = Report::findOrFail($id);

        $output = $reports->name();

        $photos = explode('|', $reports->proof);
        $images = explode('|', $reports->inc_img);

        $pdf = PDF::loadView('print.reports',compact('reports', 'output', 'images', 'photos'));
        return $pdf->stream('reports.pdf');

    }

}
