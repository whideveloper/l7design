<?php

namespace App\Http\Controllers\Client;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Holiday;

class EventPageController extends Controller
{
    public function index(){
        $eventAll = Event::sorting()->active()->get();
        $holidays = Holiday::sorting()->active()->get();

        return view('Client.pages.calendario', [
            'eventAll' => $eventAll,
            'holidays' => $holidays,
        ]);
    }
}
