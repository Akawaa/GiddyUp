<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignVehiculeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicule', function (Blueprint $table) {
            $table->foreign('id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('modele_id')
                ->references('modele_id')
                ->on('modele')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicule', function (Blueprint $table) {
            //
        });
    }
}
