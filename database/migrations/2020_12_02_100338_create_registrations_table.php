<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("registrations", function (Blueprint $table) {
            $table->id();
            $table->foreignId("event_id");
            $table->foreignId("user_id");
            $table->timestamps();
        });

        Schema::table("registrations", function ($table) {
            /* TODO cascade delete ? https://youtu.be/_oa-VWqCuOQ?t=370 */
            $table
                ->foreign("event_id")
                ->references("id")
                ->on("events");
            $table
                ->foreign("user_id")
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
        Schema::dropIfExists("registrations");
    }
}
