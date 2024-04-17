<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendEmailController;

require __DIR__ . '/panel.php';

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('Client.pages.home');
})->name('home');

Route::get('/especialidades', function () {
    return view('Client.pages.especialidades');
})->name('especialidades');
Route::get('/mural-de-comunicacao', function () {
    return view('Client.pages.mural-de-comunicacao');
})->name('mural-de-comunicacao');
Route::get('/material-de-apoio', function () {
    return view('Client.pages.material-de-apoio');
})->name('material-de-apoio');

// Route::get('/contato', function () {
//     return view('emails.contato');
// });
Route::get('/contato', function () {
    return view('Client.pages.contato');
})->name('contato');

Route::get('/contact', function () {
    return view('contact');
});
Route::post('/contact/envia', [SendEmailController::class, 'enviarEmail'])->name('send');

// Route::get('/dashboard', function () {
//     return view('Admin.dashboard');
// });
