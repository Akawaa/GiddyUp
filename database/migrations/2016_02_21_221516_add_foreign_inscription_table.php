<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignInscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inscrit', function (Blueprint $table) {
            $table->foreign('id')
                ->references('id')
                ->on('users')->onDelete('cascade');
            $table->foreign('trajet_id')
                ->references('trajet_id')
                ->on('trajet')->onDelete('cascade');
            $table->foreign('ville_insee_depart')
                ->references('ville_insee')
                ->on('ville');
            $table->foreign('ville_insee_arrivee')
                ->references('ville_insee')
                ->on('ville');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inscription', function (Blueprint $table) {
            //
        });
    }
}
