<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_section', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('lesson_id');
          $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
          $table->unsignedInteger('section_id');
          $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_section');
    }
}
