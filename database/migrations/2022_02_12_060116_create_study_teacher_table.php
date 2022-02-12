<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_teacher', function (Blueprint $table) {
            $table->unsignedBigInteger('study_id');
            $table->unsignedBigInteger('teacher_id');
            $table->timestamps();

            $table->foreign('study_id')->references('id')->on('studies')->onDelete('CASCADE');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('study_teacher');
    }
}
