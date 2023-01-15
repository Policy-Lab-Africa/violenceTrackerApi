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
        Schema::create('ng_local_governments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_id')->index();
            $table->string('name')->nullable();
            $table->string('abbreviation')->nullable();
            $table->foreignId('state_id')->references('data_id')->on('ng_states');
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
        Schema::dropIfExists('ng_local_governments');
    }
};
