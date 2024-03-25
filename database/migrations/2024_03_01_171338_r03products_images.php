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
        Schema::create('r03products_images', function (Blueprint $table) {
            $table->id('r03id');
            $table->unsignedBigInteger('r03product');
            $table->string('image_path');
            $table->timestamps();
            $table->foreign('r03product')->references('t04id')->on('t04productos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
