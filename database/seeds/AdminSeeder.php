<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_users')->insert([
            'id' => 1,
            'name' => 'Супер админ',
            'login' => 'admin',
            'password' => Hash::make('khpkadmin54976'),
            'privileges_id' => 1,
            'institution_id' => 1,
        ]);
    }
}
