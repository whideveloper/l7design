<?php

namespace App\Http\Controllers\Client;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Holiday;

class EventPageController extends Controller
{
    public function index(){
        $currentEvent = Event::orderBy('date_start', 'ASC')
        ->whereMonth('date_start', '=', date('m'))
        ->sorting()
        ->active()
        ->get();

        $eventAll = Event::orderBy('date_start', 'ASC')
        ->sorting()
        ->active()
        ->get();
        $holidays = Holiday::sorting()->active()->get();

        return view('Client.pages.calendario', [
            'eventAll' => $eventAll,
            'holidays' => $holidays,
            'currentEvent' => $currentEvent,
        ]);
    }
}
