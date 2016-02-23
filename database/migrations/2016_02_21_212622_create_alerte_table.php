<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlerteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerte', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('alert_id');
            $table->string('alerte_heure',5);
            $table->integer('id')->unsigned();
            $table->string('ville_insee_depart',15);
            $table->string('ville_insee_arrivee',15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alerte');
    }
}
