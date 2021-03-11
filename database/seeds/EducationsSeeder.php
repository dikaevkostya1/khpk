<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('educations')->insert([
            'name' => 'Аттестат'
        ]);
        DB::table('educations')->insert([
            'name' => 'Диплом'
        ]);
    }
}
