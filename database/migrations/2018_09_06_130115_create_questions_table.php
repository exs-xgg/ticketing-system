<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            // $table->unsignedInteger('assignment_id')->nullable();
            $table->unsignedInteger('quiz_id')->nullable();
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
            $table->string('question');
            $table->string('question_image')->nullable();
            $table->string('correct');
            $table->string('option_one')->nullable();;
            $table->string('option_two')->nullable();;
            $table->string('option_three')->nullable();;
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
        Schema::dropIfExists('questions');
    }
}
