<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrajetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trajet', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('trajet_id');
            $table->date('trajet_date');
            $table->string('trajet_heure');
            $table->tinyInteger('trajet_place');
            $table->float('trajet_tarif');
            $table->boolean('trajet_autoroute');
            $table->integer('trajet_detour');
            $table->integer('trajet_decalage_depart');
            $table->tinyInteger('trajet_bagage');
            $table->longText('trajet_info');
            $table->integer('trajet_distance');
            $table->string('trajet_duree',5);
            $table->integer('id')->unsigned();
            $table->integer('vehicule_id')->unsigned();
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
        Schema::drop('trajet');
    }
}
