<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $holidays = [
            ['title' => 'Ano Novo', 'date_holiday' => '2024-01-01'],
            ['title' => 'Carnaval', 'date_holiday' => '2024-02-12'],
            ['title' => 'Paixão de Cristo', 'date_holiday' => '2024-03-29'],
            ['title' => 'Tiradentes', 'date_holiday' => '2024-04-21'],
            ['title' => 'Dia do Trabalhador', 'date_holiday' => '2024-05-01'],
            ['title' => 'Corpus Christi', 'date_holiday' => '2024-05-30'],
            ['title' => 'Independência do Brasil', 'date_holiday' => '2024-09-07'],
            ['title' => 'Nossa Senhora Aparecida', 'date_holiday' => '2024-10-12'],
            ['title' => 'Finados', 'date_holiday' => '2024-11-02'],
            ['title' => 'Proclamação da República', 'date_holiday' => '2024-11-15'],
            ['title' => 'Natal', 'date_holiday' => '2024-12-25'],
        ];

        foreach ($holidays as $key => $holiday) {
            DB::table('holidays')->insert([
                'title' => $holiday['title'],
                'slug' => Str::slug($holiday['title'], '-'),
                'active' => true,
                'sorting' => $key + 1,
                'date_holiday' => $holiday['date_holiday'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
