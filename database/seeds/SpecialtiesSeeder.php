<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialties')->insert([
            'code' => '09.02.07',
            'name' => 'Информационные системы и программирование',
            'term_study' => '3г. 10мес.',
            'finansing_id' => 1,
            'number_seats' => 25,
            'qualification' => 'Разработчик Web и мультимедийных приложений',
            'institution_id' => 1,
            'format_id' => 1,
        ]);
    }
}
