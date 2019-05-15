<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcernsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concerns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prob_category')->index();
            $table->string('ticket')->nullable();
            $table->string('receiver1')->nullable();
            $table->string('receiver2')->nullable();
            $table->string('priority')->nullable();
            $table->string('status')->nullable();
            $table->text('remark')->nullable();
            $table->string('reporter')->nullable();
            $table->string('sub_category')->nullable();
            $table->text('problem')->nullable();
            $table->text('before')->nullable();
            
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
        Schema::dropIfExists('concerns');
    }
}
