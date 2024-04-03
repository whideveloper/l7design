<?php

namespace App\Http\Controllers\Client;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        $slides = Banner:: sorting()->active()->get();

        return view('Client.pages.home', [
            'slides' => $slides
        ]);
    }
}
