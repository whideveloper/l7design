<?php

use App\Models\Partner;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\Client\HomePageController;

require __DIR__ . '/panel.php';

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('Client.pages.home');
// });
Route::get('/contato', function () {
    return view('emails.contato');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::post('/contact/envia', [SendEmailController::class, 'enviarEmail'])->name('send');

View::composer('Client.core.main', function ($view) {
    $partners = Partner::sorting()->active()->get();
    return $view->with('partners', $partners);
});