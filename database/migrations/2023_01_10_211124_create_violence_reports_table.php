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
        Schema::create('violence_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ng_state_id')->nullable(); //->refernces('data_id')->on('ng_states')
            $table->foreignId('ng_local_government_id')->nullable(); //->refernces('data_id')->on('ng_local_governments')
            $table->foreignId('ng_polling_unit'); //->refernces('data_id')->on('ng_polling_units')
            $table->foreignId('type_id')->refernces('id')->on('violence_types')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('violence_reports');
    }
};
