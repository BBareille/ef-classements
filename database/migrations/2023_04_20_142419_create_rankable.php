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
        Schema::dropIfExists('rankables');
        Schema::create('rankables', function (Blueprint $table) {
            $table->unsignedInteger('ranking_id');
            $table->string('rankable_id');
            $table->string('rankable_type');
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
