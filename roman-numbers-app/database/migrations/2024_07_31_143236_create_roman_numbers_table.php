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
        Schema::create('roman_numbers', function (Blueprint $table) {
            $table->id();
            $table->integer('arabic')->unique(); // numero arabico a ser convertido 1, 2, 3
            $table->string('roman')->unique();   // numero romano correspondente I, II, III
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roman_numbers');
    }
};
