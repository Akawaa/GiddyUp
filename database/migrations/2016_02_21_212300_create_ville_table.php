<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVilleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ville', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('ville_nom',50);
            $table->string('ville_nom_reel',50);
            $table->string('ville_code_postal',255);
            $table->string('ville_insee',15);
            $table->float('ville_long');
            $table->float('ville_lat');
            $table->primary('ville_insee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ville');
    }
}
