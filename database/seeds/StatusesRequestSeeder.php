<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses_request')->insert([
            'code' => 1,
            'name' => 'Рассматривается'
        ]);
        DB::table('statuses_request')->insert([
            'code' => 2,
            'name' => 'Отклонена'
        ]);
        DB::table('statuses_request')->insert([
            'code' => 3,
            'name' => 'Принята'
        ]);
        DB::table('statuses_request')->insert([
            'code' => 4,
            'name' => 'Вы зачислены'
        ]);
    }
}
