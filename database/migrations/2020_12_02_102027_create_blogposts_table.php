<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogpostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("blogposts", function (Blueprint $table) {
            $table->id();
            $table->foreignId("author_id")->nullable();
            $table->text("title");
            $table->text("content");
            $table->timestamps();
        });
        Schema::table("blogposts", function ($table) {
            /* TODO cascade delete ? https://youtu.be/_oa-VWqCuOQ?t=370 */
            $table
                ->foreign("author_id")
                ->references("id")
                ->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("blogposts");
    }
}
