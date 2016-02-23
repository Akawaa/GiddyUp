<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('site_id');
            $table->string('site_nom',50);
            $table->string('site_adresse',100);
            $table->integer('universite_id')->unsigned();
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
        Schema::drop('site');
    }
}
