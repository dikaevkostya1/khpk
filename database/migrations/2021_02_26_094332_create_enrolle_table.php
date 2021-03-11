<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrolleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolle', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('address_actual');
            $table->string('address_registration');
            $table->string('phone', 11);
            $table->date('date_born');
            $table->string('place_born');
            $table->integer('passport_series');
            $table->integer('passport_number');
            $table->date('passport_date');
            $table->string('passport_issued');
            $table->integer('education_id')->unsigned();
            $table->year('education_ending');
            $table->string('education_name');
            $table->integer('education_series');
            $table->integer('education_number');
            $table->string('login')->unique();
            $table->string('mail')->unique();
            $table->string('password');
            $table->boolean('email_verified_at');
            $table->integer('email_verified_code');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrolle');
    }
}
