<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/panel.php';

Route::get('/', function () {
    return view('welcome');
});
Route::get('/contato', function () {
    return view('emails.contato');
});

// Route::get('/dashboard', function () {
//     return view('Admin.dashboard');
// });

