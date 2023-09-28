<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;


Route::get('painel/', function () {
    return redirect()->route('admin.dashboard.painel');
});
Route::prefix('painel/')->group(function () {
    Route::get('/login', function () {
        return view('Admin.auth.login');
    })->name('admin.dashboard.painel');
    
    // Rota para exibir o formulário "Esqueci a senha"
    Route::get('password/reset', [ForgotPasswordController::class, 'viewForm'])
        ->name('password.request');
    // Rota para processar o formulário "Esqueci a senha"
    Route::post('password/email', [SendEmailController::class, 'sendResetLinkEmail'])
        ->name('password.email');
    // Rota para exibir o formulário de redefinição de senha
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    // Rota para processar a redefinição de senha
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

    Route::post('login.do', [AuthController::class, 'authenticate'])->name('admin.user.authenticate');

    Route::middleware('auth')->group(function(){
        
        Route::get('/dashboard', function () {
            return view('Admin.dashboard');
        })->name('admin.dashboard');
        
        //GRUPOS
        Route::resource('grupos', RoleController::class)
        ->names('admin.dashboard.group')
        ->parameters(['grupos' => 'role']);
        Route::post('grupos/delete', [RoleController::class, 'destroySelected'])
            ->name('admin.dashboard.group.destroySelected');
        Route::post('grupos/sorting', [RoleController::class, 'sorting'])
            ->name('admin.dashboard.group.sorting');

        //USUARIOS
        Route::resource('usuario', UserController::class)
            ->names('admin.dashboard.user')
            ->parameters(['usuario'=>'user']);
        Route::post('usuario/delete', [UserController::class, 'destroySelected'])
            ->name('admin.dashboard.user.destroySelected');
        Route::post('usuario/sorting', [UserController::class, 'sorting'])
            ->name('admin.dashboard.user.sorting');
        
        //CONTATO
        Route::resource('contato', ContactController::class)
            ->names('admin.dashboard.contact')
            ->parameters(['contato'=>'contact']);
        Route::post('contato/delete', [ContactController::class, 'destroySelected'])
            ->name('admin.dashboard.contact.destroySelected');
        Route::post('contato/sorting', [ContactController::class, 'sorting'])
            ->name('admin.dashboard.contact.sorting');
        Route::post('contato/search', [ContactController::class, 'index'])
            ->name('admin.dashboard.contact.search');
        
        // LOGOUT
        Route::get('logout', [AuthController::class, 'logout'])->name('admin.dashboard.user.logout');
    });
});

View::composer('Admin.core.admin', function ($view) {
    $user = User::where('id', Auth::user()->id)->first();
    return $view->with('user', $user);
});