<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("events", function (Blueprint $table) {
            $table->id();
            $table->string("type");
            $table->text("description")->nullable();
            $table->date("date_start");
            $table->date("date_end");
            $table->smallInteger("price")->nullable();
            $table->unsignedTinyInteger("slots")->nullable();
            $table->unsignedTinyInteger("slots_left")->nullable();
            $table
                ->unsignedTinyInteger("slots_taken")
                ->default("0")
                ->nullable();
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
        Schema::dropIfExists("events");
    }
}
