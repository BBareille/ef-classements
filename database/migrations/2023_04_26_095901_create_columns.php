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
        Schema::dropIfExists('columns');
        Schema::create('columns', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('isDisplayed');
            $table->smallInteger('weight');
            $table->integer('value');
            $table->unsignedInteger('ranking_id');

            $table->foreign('ranking_id')->references('id')->on('rankings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('columns');
    }
};
