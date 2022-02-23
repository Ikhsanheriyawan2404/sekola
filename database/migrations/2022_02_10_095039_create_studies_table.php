<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('study_code')->nullable();
            $table->unsignedBigInteger('major_id');
            $table->enum('type', ['Umum', 'Kejuruan', 'Khusus']);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('major_id')->references('id')->on('majors')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studies');
    }
}
