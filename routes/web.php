<?php

use App\Models\Partner;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\Client\HomePageController;
use App\Http\Controllers\Client\EspecialidadePageController;

require __DIR__ . '/panel.php';

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('Client.pages.home');
})->name('home');

// Route::get('/especialidades', function () {
//     return view('Client.pages.especialidades');
// })->name('especialidades');
Route::get('/mural-de-comunicacao', function () {
    return view('Client.pages.mural-de-comunicacao');
})->name('mural-de-comunicacao');
Route::get('/mural-de-comunicacao-interna', function () {
    return view('Client.pages.mural-de-comunicacao-interna');
})->name('mural-de-comunicacao-interna');
Route::get('/material-de-apoio', function () {
    return view('Client.pages.material-de-apoio');
})->name('material-de-apoio');
Route::get('/savs', function () {
    return view('Client.pages.savs');
})->name('savs');
Route::get('/galeria', function () {
    return view('Client.pages.galeria');
})->name('galeria');
Route::get('/galeria-interna', function () {
    return view('Client.pages.galeria-interna');
})->name('galeria-interna');
Route::get('/desempenho', function () {
    return view('Client.pages.desempenho');
})->name('desempenho');
// Route::get('/', function () {
//     return view('Client.pages.home');
// });
Route::get('/contato', function () {
    return view('Client.pages.contato');
})->name('contato');
Route::get('/calendario', function () {
    return view('Client.pages.calendario');
})->name('calendario');

// Route::get('/contato', function () {
//     return view('emails.contato');
// });

Route::get('/contact', function () {
    return view('contact');
});
Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/especialidades', [EspecialidadePageController::class, 'index'])->name('especialidades');
Route::post('/contact/envia', [SendEmailController::class, 'enviarEmail'])->name('send');

View::composer('Client.core.main', function ($view) {
    $partners = Partner::sorting()->active()->get();
    return $view->with('partners', $partners);
});