<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Banner;
use App\Models\Proadi;
use App\Models\Hospital;
use App\Models\Location;
use App\Models\Depoiment;
use App\Models\HowItWork;
use App\Models\Objective;
use App\Models\StepToStep;
use App\Models\Telenordeste;
use App\Models\Teleinterconsulta;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        $slides = Banner:: sorting()->active()->get();
        $telenordeste = Telenordeste::active()->first();
        $location = Location::active()->first();
        $objectives = Objective::sorting()->active()->get();
        $teleinterconsulta = Teleinterconsulta::active()->first();
        $howItWork = HowItWork::active()->first();
        $stepToSteps = StepToStep::sorting()->active()->get();
        $hospital = Hospital::active()->first();
        $proadi = Proadi::active()->first();
        $depoiments = Depoiment::sorting()->active()->get();
        $currentDate = Carbon::now();
        $startOfWeek = $currentDate->startOfWeek(Carbon::SUNDAY)->format('Y-m-d');
        $endOfWeek = $currentDate->endOfWeek(Carbon::SATURDAY)->format('Y-m-d');
        $eventAll = Event::whereMonth('date_start', '=', date('m'))->whereBetween('date_start', [$startOfWeek, $endOfWeek])
        ->sorting()
        ->active()
        ->get();    
        return view('Client.pages.home', [
            'slides' => $slides,
            'telenordeste' => $telenordeste,
            'location' => $location,
            'objectives' => $objectives,
            'teleinterconsulta' => $teleinterconsulta,
            'howItWork' => $howItWork,
            'stepToSteps' => $stepToSteps,
            'hospital' => $hospital,
            'proadi' => $proadi,
            'depoiments' => $depoiments,
            'eventAll' => $eventAll,
        ]);
    }
}
