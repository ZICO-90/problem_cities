<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_problems', function (Blueprint $table) {
            $table->id();
            $table->string('problem_name');
            $table->string('tool_defect')->nullable();
            $table->longText('problem_details');
            $table->string('who_cause_of_defect')->nullable();
            $table->enum('problem_current_status', ['a', 'b' ,'c' ,'d','e'])->default('a');
            $table->enum('tap_order_status', ['1', '2','3','4'])->default('1');

            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('side_defect_id')->unsigned();
            $table->bigInteger('cause_of_defect_id')->unsigned();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register_problems');
    }
}
