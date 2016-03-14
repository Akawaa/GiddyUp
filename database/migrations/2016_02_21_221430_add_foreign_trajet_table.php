<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignTrajetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trajet', function (Blueprint $table) {
            $table->foreign('id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('vehicule_id')
                ->references('vehicule_id')
                ->on('vehicule');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trajet', function (Blueprint $table) {
            //
        });
    }
}
