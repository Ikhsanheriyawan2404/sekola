<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('topic')->nullable();
            $table->text('description')->nullable();
            $table->string('file')->nullable();
            $table->string('reference')->nullable();
            $table->unsignedBigInteger('study_id');
            $table->unsignedBigInteger('classroom_id');
            $table->unsignedBigInteger('teacher_id');
            $table->timestamps();

            $table->foreign('study_id')->references('id')->on('studies')->onDelete('CASCADE');
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('CASCADE');
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
        Schema::dropIfExists('modules');
    }
}
