<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SpecialtiesSeeder::class);
        $this->call(InstitutionsSeeder::class);
        $this->call(EducationsSeeder::class);
        $this->call(StatusesRequestSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(QualificationSeeder::class);
    }
}