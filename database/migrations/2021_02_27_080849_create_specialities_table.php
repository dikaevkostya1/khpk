<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialties', function (Blueprint $table) {
            $table->id();
            $table->string('code', 8);
            $table->string('name');
            $table->string('term_study');
            $table->integer('finansing_id')->unsigned();
            $table->integer('number_seats');
            $table->string('qualification');
            $table->integer('institution_id')->unsigned();
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
        Schema::dropIfExists('specialities');
    }
}
