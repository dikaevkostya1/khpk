<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionDeadlineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_deadline', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start');
            $table->dateTime('ending');
            $table->integer('format_id')->unsigned();
            $table->integer('institution_id')->unsigned();
            $table->year('year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admission_deadline');
    }
}
