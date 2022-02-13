<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('day', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum`at', 'Sabtu', 'Minggu']);
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('study_id');
            $table->unsignedBigInteger('classroom_id');
            $table->unsignedBigInteger('room_id');
            $table->time('start');
            $table->time('finished');
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('CASCADE');
            $table->foreign('study_id')->references('id')->on('studies')->onDelete('CASCADE');
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('CASCADE');
            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
