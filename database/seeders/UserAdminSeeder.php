<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'administrador@gmail.com.br',
            'password' => '$2y$12$HK.V4hsv1XLgO66Yo55sJ.JGENt/7UlHdlftx.FOlPm30Rlh43wta',
            'active' => 1,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now()
        ]);
    }
}
