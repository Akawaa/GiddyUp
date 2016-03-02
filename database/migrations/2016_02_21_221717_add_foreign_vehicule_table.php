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
                ->on('users');
            $table->foreign('modele_id')
                ->references('modele_id')
                ->on('modele');
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
