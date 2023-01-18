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
        Schema::create('ng_polling_units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_id')->index();
            $table->string('name')->nullable()->index();
            $table->integer('registration_area_id')->index()->nullable();
            $table->string('precise_location')->nullable();
            $table->string('abbreviation')->nullable();
            $table->string('units')->nullable();
            $table->string('delimitation')->nullable();
            $table->string('remark')->nullable();
            $table->foreignId('ward_id')->nullable(); // ->references('data_id')->on('ng_wards')
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
        Schema::dropIfExists('ng_polling_units');
    }
};
