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
            $table->bigInteger('faction_id')->foreign('faction_id')->references('id')->on('faction')->nullable();
            $table->unsignedInteger('kills');
            $table->unsignedInteger('deaths');

            $table->foreign('user_id')->references('id')->on('users');
/*            $table;*/
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
