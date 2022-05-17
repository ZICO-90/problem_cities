<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStarRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('star_ratings', function (Blueprint $table) {
            $table->id();
            $table->decimal('rating',2,1);
            $table->integer('star');
            $table->text('comment')->default('لا يوجد تعليق لهذا التقييم ,شكرا')->nullable();
            $table->bigInteger('register_problem_id')->unsigned();
            $table->timestamps();

            $table->foreign('register_problem_id')
            ->references('id')
            ->on('register_problems')
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
        Schema::dropIfExists('star_ratings');
    }
}
