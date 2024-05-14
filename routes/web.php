<?php

use App\Http\Controllers\Client\ContactTelenordestePageController;
use App\Models\Partner;
use App\Models\Material;
use App\Models\Protocol;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\Client\SavPageController;
use App\Http\Controllers\Client\HomePageController;
use App\Http\Controllers\Client\EspecialidadePageController;
use App\Http\Controllers\Client\MaterialDeApoioPageController;
use App\Http\Controllers\Client\MuralDeComunicacaoPageController;
use App\Http\Controllers\Client\MuralDeComunicacaoInternaPageController;

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
// Route::get('/mural-de-comunicacao', function () {
//     return view('Client.pages.mural-de-comunicacao');
// })->name('mural-de-comunicacao');
// Route::get('/mural-de-comunicacao-interna', function () {
//     return view('Client.pages.mural-de-comunicacao-interna');
// })->name('mural-de-comunicacao-interna');
// Route::get('/material-de-apoio', function () {
//     return view('Client.pages.material-de-apoio');
// })->name('material-de-apoio');
// Route::get('/savs', function () {
//     return view('Client.pages.savs');
// })->name('savs');
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
// Route::get('/contato', function () {
//     return view('Client.pages.contato');
// })->name('contato');
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
Route::get('/especialidades/{category}', [EspecialidadePageController::class, 'index'])->name('especialidades-category');
Route::get('/material-de-apoio', [MaterialDeApoioPageController::class, 'index'])->name('material-de-apoio');
Route::get('/mural-de-comunicacao', [MuralDeComunicacaoPageController::class, 'index'])->name('mural-de-comunicacao');
Route::get('/mural-de-comunicacao/{category}', [MuralDeComunicacaoPageController::class, 'index'])->name('mural-de-comunicacao-category');
Route::get('/mural-de-comunicacao-interna/{slug}/{title}', [MuralDeComunicacaoInternaPageController::class, 'index'])->name('mural-de-comunicacao-interna');
Route::get('/mural-de-comunicacao-interna/{slug}/relacionados', [MuralDeComunicacaoInternaPageController::class, 'relacionados'])->name('mural-de-comunicacao-interna-relacionados');
Route::get('/savs', [SavPageController::class, 'index'])->name('savs');
Route::get('/contato', [ContactTelenordestePageController::class, 'index'])->name('contato');
Route::post('/contact/envia', [SendEmailController::class, 'enviarEmail'])->name('send');

View::composer('Client.core.main', function ($view) {
    $partners = Partner::sorting()->active()->get();
    $materialSections = Material::active()->get();
    $protocolo = Protocol::active()->first();
    return $view->with('partners', $partners)
    ->with('protocolo', $protocolo)->with('materialSections', $materialSections);
});