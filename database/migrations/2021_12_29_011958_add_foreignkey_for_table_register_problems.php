<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignkeyForTableRegisterProblems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('register_problems', function (Blueprint $table) {
            $table->foreign('city_id')
            ->references('id')
            ->on('cities')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('side_defect_id')
            ->references('id')
            ->on('side_defects')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('cause_of_defect_id')
            ->references('id')
            ->on('sause_of_defects')
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
            $table->dropForeign(['city_id']);
            $table->dropForeign(['side_defect_id']);
            $table->dropForeign(['cause_of_defect_id']);
        });
    }
}
