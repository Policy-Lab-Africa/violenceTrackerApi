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
        Schema::create('ng_pu_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ng_polling_unit_id')->references('data_id')->on('ng_polling_units');
            $table->string('latitude')->index()->nullable();
            $table->string('longitude')->index()->nullable();
            $table->json('viewport')->nullable();
            $table->string('formatted_address')->nullable();
            $table->string('google_map_url')->nullable();
            $table->string('google_place_id')->nullable();
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
        Schema::dropIfExists('ng_pu_locations');
    }
};
