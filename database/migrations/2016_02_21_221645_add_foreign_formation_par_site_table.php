<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignFormationParSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formation_par_site', function (Blueprint $table) {
            $table->foreign('site_id')
                ->references('site_id')
                ->on('site');
            $table->foreign('formation_id')
                ->references('formation_id')
                ->on('formation');
            $table->primary(['site_id','formation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formation_par_site', function (Blueprint $table) {
            //
        });
    }
}
