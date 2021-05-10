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
            'id' => 1,
            'code' => '09.02.07',
            'name' => 'Информационные системы и программирование',
            'institution_id' => 1
        ]);
        DB::table('specialties')->insert([
            'code' => '23.02.04',
            'name' => 'Техническая эксплуатация и ремонт подъемно-транспортных, строительных и дорожных машин и оборудования',
            'institution_id' => 1
        ]);
        DB::table('specialties')->insert([
            'code' => '23.02.07',
            'name' => 'Техническое обслуживание и ремонт двигателей, систем и агрегатов автомобилей',
            'institution_id' => 1
        ]);
        DB::table('specialties')->insert([
            'code' => '35.02.03',
            'name' => 'Технология деревообработки',
            'institution_id' => 1
        ]);
        DB::table('specialties')->insert([
            'code' => '38.02.01',
            'name' => 'Экономика и бухгалтерский учет',
            'institution_id' => 1
        ]);
    }
}
