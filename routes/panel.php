<?php

use App\Http\Controllers\ContactController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\AuthController;


Route::get('painel/', function () {
    return redirect()->route('admin.dashboard.painel');
});
Route::prefix('painel/')->group(function () {
    Route::get('/login', function () {
        return view('Admin.auth.login');
    })->name('admin.dashboard.painel');
    
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
        
        // LOGOUT
        Route::get('logout', [AuthController::class, 'logout'])->name('admin.dashboard.user.logout');
    });
});

View::composer('Admin.core.admin', function ($view) {
    $user = User::where('id', Auth::user()->id)->first();
    return $view->with('user', $user);
});