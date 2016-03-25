<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscritTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscrit', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id')->unsigned();
            $table->integer('trajet_id')->unsigned();
            $table->primary(['id','trajet_id']);
            $table->tinyInteger('inscription_avis_conducteur');
            $table->string('inscription_commentaire_conducteur');
            $table->date('inscription_date_commentaire_conducteur');
            $table->tinyInteger('inscription_avis_voyageur');
            $table->string('inscription_commentaire_voyageur');
            $table->date('inscription_date_commentaire_voyageur');
            $table->tinyInteger('inscription_valide');
            $table->integer('ville_insee_depart')->unsigned();
            $table->interger('ville_insee_arrivee')->unsigned();
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
        Schema::drop('inscrit');
    }
}
