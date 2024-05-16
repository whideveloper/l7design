<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $max_allowed_packet = 2097152; // Valor em bytes (2MB)

        // Convertendo o valor para uma string e executando a query
        // DB::statement("SET GLOBAL max_allowed_packet={$max_allowed_packet}");
    }
}
