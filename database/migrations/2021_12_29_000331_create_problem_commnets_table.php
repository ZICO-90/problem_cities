<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemCommnetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem_commnets', function (Blueprint $table) {
            $table->id();
            $table->longText('commnets_body');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('register_problem_id')->unsigned();
            $table->bigInteger('parent_commnet_id')->unsigned()->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('problem_commnets');
    }
}
