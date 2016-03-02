<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignVehiculeCouleurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicule', function (Blueprint $table) {
            $table->foreign('couleur_id')
                ->references('couleur_id')
                ->on('couleur');
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
