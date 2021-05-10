<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialties_qualifications')->insert([
            'speciality_id' => 1,
            'term_study' => '3г. 10мес.',
            'finansing_id' => 1,
            'number_seats' => 25,
            'qualification' => 'Разработчик Web и мультимедийных приложений',
            'format_id' => 1
        ]);
        DB::table('specialties_qualifications')->insert([
            'speciality_id' => 1,
            'term_study' => '3г. 10мес.',
            'finansing_id' => 1,
            'number_seats' => 25,
            'qualification' => 'Программист',
            'format_id' => 1
        ]);
        DB::table('specialties_qualifications')->insert([
            'speciality_id' => 1,
            'term_study' => '3г. 10мес.',
            'finansing_id' => 1,
            'number_seats' => 25,
            'qualification' => 'Администратор баз данных',
            'format_id' => 1
        ]);
    }
}
