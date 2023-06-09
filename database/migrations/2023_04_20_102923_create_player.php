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
        Schema::dropIfExists('players');
        Schema::create('players', function (Blueprint $table) {
            $table->text('id')->primary();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('faction_id')->nullable(true);
            $table->unsignedInteger('kills');
            $table->unsignedInteger('deaths');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('faction_id')->references('id')->on('faction');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player');
    }
};
