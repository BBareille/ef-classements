<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranking_to_faction', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('faction_id');
            $table->unsignedInteger('ranking_id');

            $table->foreign('faction_id')->references('id')->on('faction');
            $table->foreign('ranking_id')->references('id')->on('ranking');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ranking_to_faction');
    }
};
