<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universite', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('universite_id');
            $table->string('universite_nom',50);
            $table->string('universite_adresse',100);
            $table->string('universite_tel',20);
            $table->string('universite_logo',50);
            $table->string('ville_insee',15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('universite');
    }
}
