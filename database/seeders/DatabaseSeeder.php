<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\HolidaySeeder;
use Database\Seeders\UserAdminSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create();
        $this->call([
            PermissionsSeeder::class,
            RoleSeeder::class,
            ModelHasRoleSeeder::class,
            UserAdminSeeder::class,
            HolidaySeeder::class,
        ]);
    }
}
