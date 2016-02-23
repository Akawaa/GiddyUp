<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicule', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('vehicule_id');
            $table->string('vehicule_photo',50)->nullable();
            $table->tinyInteger('vehicule_confort')->nullable();
            $table->tinyInteger('vehicule_place')->nullable();
            $table->string('vehicule_couleur',20)->nullable();
            $table->boolean('vehicule_defaut')->nullable();
            $table->integer('id')->unsigned();
            $table->integer('modele_id')->unsigned();
            $table->integer('type_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vehicule');
    }
}
