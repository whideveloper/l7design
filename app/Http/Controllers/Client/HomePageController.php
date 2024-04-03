<?php

namespace App\Http\Controllers\Client;

use App\Models\Banner;
use App\Models\Hospital;
use App\Models\Location;
use App\Models\HowItWork;
use App\Models\Objective;
use App\Models\StepToStep;
use App\Models\Telenordeste;
use Illuminate\Http\Request;
use App\Models\Teleinterconsulta;
use App\Http\Controllers\Controller;
use App\Models\Depoiment;
use App\Models\Proadi;

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
        ]);
    }
}
