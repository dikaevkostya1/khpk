<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialtiesQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialties_qualifications', function (Blueprint $table) {
            $table->id();
            $table->integer('speciality_id')->unsigned();
            $table->string('term_study');
            $table->integer('finansing_id')->unsigned();
            $table->integer('number_seats');
            $table->string('qualification');
            $table->integer('format_id')->unsigned();
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
        Schema::dropIfExists('specialties_qualifications');
    }
}
