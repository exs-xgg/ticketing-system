<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
       public function up()
    {
           Schema::create('region', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
         
            $table->string('region');
        });

            DB::table('region')
        ->insert([
          ['id' => '01','Region' => 'REGION I (Ilocos Region)'],
          ['id' => '02','Region' => 'REGION II (Cagayan Valley)'],
          ['id' => '03','Region' => 'REGION III (Central Luzon)'],
          ['id' => '04','Region' => 'REGION IV-A (CALABARZON)'],
          ['id' => '05','Region' => 'REGION V (Bicol Region)'],
          ['id' => '06','Region' => 'REGION VI (Western Visayas)'],
          ['id' => '07','Region' => 'REGION VII (Central Visayas)'],
          ['id' => '08','Region' => 'REGION VIII (Eastern Visayas)'],
          ['id' => '09','Region' => 'REGION IX (Zamboanga Peninsula)'],
          ['id' => '10','Region' => 'REGION X (Nothern Mindanao)'],
          ['id' => '11','Region' => 'REGION XI (Davao Region)'],
          ['id' => '12','Region' => 'REGION XII (Soccsksargen)'],
          ['id' => '13','Region' => 'NCR - National Capital Region'],
          ['id' => '14','Region' => 'CAR - Cordillera Administrative Region'],
          ['id' => '15','Region' => 'ARMM - Autonomous Region in Muslim Mindanao'],
          ['id' => '16','Region' => 'REGION XIII (Caraga)'],
          ['id' => '17','Region' => 'REGION IV-B (MIMAROPA)'],
          ['id' => '18','Region' => 'NIR - Negros Island Region']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('region');
    }
}


