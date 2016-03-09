<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignEtapeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('etape', function (Blueprint $table) {
            $table->foreign('trajet_id')
                ->references('trajet_id')
                ->on('trajet')
                ->onDelete('cascade');
            $table->foreign('ville_insee')
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
        Schema::table('etape', function (Blueprint $table) {
            //
        });
    }
}
