<?php

namespace App\Http\Controllers\Client;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventPageController extends Controller
{
    public function index(){
        $events = Event::sorting()->active()->get();
        return view('Client.pages.calendario', [
            'events' => $events
        ]);
    }
}
