<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->date('date');
            $table->time('start');
            $table->time('finished');
            $table->time('time');
            $table->number('number_of_questions');
            $table->string('status')->default(1);
            $table->unsignedBigInteger('tacher_id');
            $table->unsignedBigInteger('study_id');
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
        Schema::dropIfExists('quizzes');
    }
}
