<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignAlerteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alerte', function (Blueprint $table) {
            $table->foreign('id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
        Schema::table('alerte', function (Blueprint $table) {
            //
        });
    }
}
