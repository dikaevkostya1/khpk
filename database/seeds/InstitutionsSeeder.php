<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institutions')->insert([
            'name' => 'Колледж'
        ]);
        DB::table('institutions')->insert([
            'name' => 'Филиал'
        ]);
    }
}
