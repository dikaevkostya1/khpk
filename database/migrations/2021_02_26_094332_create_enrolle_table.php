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
            $table->string('address');
            $table->string('phone', 11);
            $table->date('date_born');
            $table->integer('education_id')->unsigned()->default(1);
            $table->year('education_ending');
            $table->string('login')->unique();
            $table->string('mail')->unique();
            $table->string('password');
            $table->boolean('verified');
            $table->integer('institution_id')->unsigned();
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
