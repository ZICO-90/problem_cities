<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignkeyForTableProblemComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('problem_commnets', function (Blueprint $table) {
            $table->foreign('register_problem_id')
            ->references('id')
            ->on('register_problems')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('parent_commnet_id')
            ->references('id')
            ->on('problem_commnets')
            ->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('problem_commnets', function (Blueprint $table) {
            $table->dropForeign(['register_problem_id']);
            $table->dropForeign(['parent_commnet_id']);
        });
    }
}
