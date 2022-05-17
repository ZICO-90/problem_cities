<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignkeyBlogsidForTableBlogcomments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_comments', function (Blueprint $table) {
            $table->foreign('blog_id')
            ->references('id')
            ->on('blogs')
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
        Schema::table('blog_comments', function (Blueprint $table) {
            $table->dropForeign(['blog_id']);
        });
    }
}
