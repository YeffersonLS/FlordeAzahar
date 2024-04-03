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
        Schema::create('r05combo_images', function (Blueprint $table) {
            $table->id('r05id');
            $table->unsignedBigInteger('r05combo');
            $table->string('image_path');
            $table->timestamps();
            $table->foreign('r05combo')->references('t10id')->on('t10combos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r05combo_images');
    }
};
