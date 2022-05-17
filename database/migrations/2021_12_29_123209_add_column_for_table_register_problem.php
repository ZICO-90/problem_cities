<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnForTableRegisterProblem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('register_problems', function (Blueprint $table) {

             $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('register_problems', function (Blueprint $table) {
            $table->dropForeign(['user_id']);

        });
    }
}
