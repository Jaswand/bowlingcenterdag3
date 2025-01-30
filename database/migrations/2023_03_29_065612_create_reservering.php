<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservering', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('persoon_id');
            $table->unsignedBigInteger('openingstijd_id');
            $table->unsignedBigInteger('tarief_id');
            $table->unsignedBigInteger('baan_id');
            $table->unsignedBigInteger('pakketoptie_id');
            $table->unsignedBigInteger('reserveringstatus_id');
            $table->integer('reserveringnummer');
            $table->date('datum');
            $table->integer('aantaluren');
            $table->time('begintijd');
            $table->time('eindtijd');
            $table->integer('aantalvolwassen');
            $table->integer('aantalkinderen');
            $table->string('isactive')->default('1');
            $table->string('opmerking')->nullable();
            $table->timestamps();

            $table->foreign('persoon_id')->references('id')->on('persoon');
            $table->foreign('openingstijd_id')->references('id')->on('openingstijd');
            $table->foreign('tarief_id')->references('id')->on('tarief');
            $table->foreign('baan_id')->references('id')->on('baan');
            $table->foreign('pakketoptie_id')->references('id')->on('pakketoptie');
            $table->foreign('reserveringstatus_id')->references('id')->on('reserveringstatus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservering');
    }
};
