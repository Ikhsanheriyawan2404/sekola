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
            $table->string('modul')->nullable();
            $table->unsignedBigInteger('studies_id');
            $table->unsignedBigInteger('classroom_id');
            $table->timestamps();

            $table->foreign('studies_id')->references('id')->on('studies')->onDelete('CASCADE');
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('CASCADE');
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
