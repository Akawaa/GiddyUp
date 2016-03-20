<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignReponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reponse', function (Blueprint $table) {
            $table->foreign('id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');


            $table->foreign('question_id')
                ->references('question_id')
                ->on('question')
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
        Schema::table('reponse', function (Blueprint $table) {
            //
        });
    }
}
