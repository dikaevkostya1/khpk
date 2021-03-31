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
            'id' => 1,
            'name' => 'Колледж'
        ]);
        DB::table('institutions')->insert([
            'id' => 2,
            'name' => 'Филиал'
        ]);
    }
}
