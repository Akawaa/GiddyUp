<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('membre_prenom',25);
            $table->string('membre_telephone',10);
            $table->string('membre_sexe',1);
            $table->integer('membre_annee_naissance');
            $table->string('membre_present',255)->nullable();
            $table->boolean('membre_casque')->nullable();
            $table->string('membre_photo',50)->nullable();
            $table->tinyInteger('membre_photo_valide')->nullable();
            $table->integer('site_id')->unsigned()->nullable();
            $table->tinyInteger('membre_pref_cig')->nullable();
            $table->tinyInteger('membre_pref_mus')->nullable();
            $table->tinyInteger('membre_pref_dis')->nullable();
            $table->tinyInteger('membre_pref_ani')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
