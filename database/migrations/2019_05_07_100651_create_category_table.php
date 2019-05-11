<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create('categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
         
            $table->string('categories');
        });

        DB::table('categories')
        ->insert([  
        ['id' => '1', 'Categories' => 'ILOCOS NORTE'],
        ['id' => '2', 'Categories' => 'ILOCOS SUR'],
        ['id' => '3', 'Categories' => 'LA UNION'],
        ['id' => '4', 'Categories' => 'PANGASINAN'],
        ['id' => '5', 'Categories' => 'BATANES'],
        ['id' => '6', 'Categories' => 'CAGAYAN'],
        ['id' => '7', 'Categories' => 'ISABELA'],
        ['id' => '8', 'Categories' => 'NUEVA VIZCAYA'],
        ['id' => '9', 'Categories' => 'QUIRINO'],
        ['id' => '10', 'Categories' => 'BATAAN'],
        ['id' => '11', 'Categories' => 'BULACAN'],
        ['id' => '12', 'Categories' => 'NUEVA ECIJA'],
        ['id' => '13', 'Categories' => 'PAMPANGA'],
        ['id' => '14', 'Categories' => 'TARLAC'],
        ['id' => '15', 'Categories' => 'ZAMBALES'],
        ['id' => '16', 'Categories' => 'AURORA'],
        ['id' => '17', 'Categories' => 'BATANGAS'],
        ['id' => '18', 'Categories' => 'CAVITE'],
        ['id' => '19', 'Categories' => 'LAGUNA'],
        ['id' => '20', 'Categories' => 'QUEZON'],
        ['id' => '21', 'Categories' => 'RIZAL'],
        ['id' => '22', 'Categories' => 'ALBAY'],
        ['id' => '23', 'Categories' => 'CAMARINES NORTE'],
        ['id' => '24', 'Categories' => 'CAMARINES SUR'],
        ['id' => '25', 'Categories' => 'CATANDUANES'],
        ['id' => '26', 'Categories' => 'MASBATE'],
        ['id' => '27', 'Categories' => 'SORSOGON'],
        ['id' => '28', 'Categories' => 'AKLAN'],
        ['id' => '29', 'Categories' => 'ANTIQUE'],
        ['id' => '30', 'Categories' => 'CAPIZ'],
        ['id' => '31', 'Categories' => 'ILOILO'],
        ['id' => '32', 'Categories' => 'GUIMARAS'],
        ['id' => '33', 'Categories' => 'BOHOL'],
        ['id' => '34', 'Categories' => 'CEBU'],
        ['id' => '35', 'Categories' => 'SIQUIJOR'],
        ['id' => '36', 'Categories' => 'EASTERN SAMAR'],
        ['id' => '37', 'Categories' => 'LEYTE'],
        ['id' => '38', 'Categories' => 'NORTHERN SAMAR'],
        ['id' => '39', 'Categories' => 'WESTERN SAMAR'],
        ['id' => '40', 'Categories' => 'SOUTHERN LEYTE'],
        ['id' => '41', 'Categories' => 'BILIRAN'],
        ['id' => '42', 'Categories' => 'ZAMBOANGA DEL NORTE'],
        ['id' => '43', 'Categories' => 'ZAMBOANGA DEL SUR'],
        ['id' => '44', 'Categories' => 'ZAMBOANGA SIBUGAY'],
        ['id' => '45', 'Categories' => 'CITY OF ISABELA'],
        ['id' => '46', 'Categories' => 'BUKidNON'],
        ['id' => '47', 'Categories' => 'CAMIGUIN'],
        ['id' => '48', 'Categories' => 'LANAO DEL NORTE'],
        ['id' => '49', 'Categories' => 'MISAMIS OCCidENTAL'],
        ['id' => '50', 'Categories' => 'MISAMIS ORIENTAL'],
        ['id' => '51', 'Categories' => 'DAVAO DEL NORTE'],
        ['id' => '52', 'Categories' => 'DAVAO DEL SUR'],
        ['id' => '53', 'Categories' => 'DAVAO ORIENTAL'],
        ['id' => '54', 'Categories' => 'COMPOSTELA VALLEY'],
        ['id' => '55', 'Categories' => 'COTABATO'],
        ['id' => '56', 'Categories' => 'SOUTH COTABATO'],
        ['id' => '57', 'Categories' => 'SULTAN KUDARAT'],
        ['id' => '58', 'Categories' => 'SARANGANI'],
        ['id' => '59', 'Categories' => 'CITY OF COTABATO'],
        ['id' => '60', 'Categories' => 'MANILA, NCR, FIRST DISTRICT'],
        ['id' => '61', 'Categories' => 'NCR SECOND DISTRICT'],
        ['id' => '62', 'Categories' => 'NCR THIRD DISTRICT'],
        ['id' => '63', 'Categories' => 'NCR FOURTH DISTRICT'],
        ['id' => '64', 'Categories' => 'ABRA'],
        ['id' => '65', 'Categories' => 'BENGUET'],
        ['id' => '66', 'Categories' => 'IFUGAO'],
        ['id' => '67', 'Categories' => 'KALINGA'],
        ['id' => '68', 'Categories' => 'MOUNTAIN id'],
        ['id' => '69', 'Categories' => 'APAYAO'],
        ['id' => '70', 'Categories' => 'BASILAN'],
        ['id' => '71', 'Categories' => 'LANAO DEL SUR'],
        ['id' => '72', 'Categories' => 'MAGUINDANAO'],
        ['id' => '73', 'Categories' => 'SULU'],
        ['id' => '74', 'Categories' => 'TAWI-TAWI'],
        ['id' => '75', 'Categories' => 'SHARIFF KABUNSUAN'],
        ['id' => '76', 'Categories' => 'AGUSAN DEL NORTE'],
        ['id' => '77', 'Categories' => 'AGUSAN DEL SUR'],
        ['id' => '78', 'Categories' => 'SURIGAO DEL NORTE'],
        ['id' => '79', 'Categories' => 'SURIGAO DEL SUR'],
        ['id' => '80', 'Categories' => 'DINAGAT ISLANDS'],
        ['id' => '81', 'Categories' => 'MARINDUQUE'],
        ['id' => '82', 'Categories' => 'OCCidENTAL MINDORO'],
        ['id' => '83', 'Categories' => 'ORIENTAL MINDORO'],
        ['id' => '84', 'Categories' => 'PALAWAN'],
        ['id' => '85', 'Categories' => 'ROMBLON'],
        ['id' => '86', 'Categories' => 'NEGROS OCCidENTAL'],
        ['id' => '87', 'Categories' => 'NEGROS ORIENTAL'],
               ]);
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('id');
    }
}
