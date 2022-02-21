<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('quiz_id');
            $table->unsignedBigInteger('question_id');
            $table->string('answer')->nullable();
            $table->enum('answered', ['yes', 'no']);
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('CASCADE');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('CASCADE');
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
