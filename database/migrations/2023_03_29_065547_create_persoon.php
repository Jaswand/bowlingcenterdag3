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
        Schema::create('persoon', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('typepersoon_id');
            $table->string('voornaam');
            $table->string('tussenvoegsel')->nullable();
            $table->string('achternaam');
            $table->string('roepnaam');
            $table->integer('isvolwassen');
            $table->string('isactive')->default('1');
            $table->string('opmerking')->nullable();
            $table->timestamps();

            $table->foreign('typepersoon_id')->references('id')->on('typepersoon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persoon');
    }
};
