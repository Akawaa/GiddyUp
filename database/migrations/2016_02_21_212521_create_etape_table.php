<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtapeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etape', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('etape_id');
            $table->integer('etape_ordre');
            $table->integer('etape_distance');
            $table->float('etape_prix');
            $table->string('etape_duree',5);
            $table->string('ville_insee',15);
            $table->integer('trajet_id')->unsigned();
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
        Schema::drop('etape');
    }
}
