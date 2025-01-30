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
        Schema::create('tarief', function (Blueprint $table) {
            $table->id();
            $table->string('eenheid');
            $table->decimal('prijs', 8, 2);
            $table->string('isactive')->default('1');
            $table->string('opmerking')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarief');
    }
};
