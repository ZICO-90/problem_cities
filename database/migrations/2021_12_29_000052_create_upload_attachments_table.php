<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('attachment_Url');
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
        Schema::dropIfExists('upload_attachments');
    }
}
