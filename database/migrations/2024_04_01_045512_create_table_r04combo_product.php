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
        Schema::create('r04combo_product', function (Blueprint $table) {
            $table->id('r04id');
            $table->unsignedBigInteger('r04combo_id');
            $table->foreign('r04combo_id')->references('t10id')->on('t10combos')->onDelete('cascade');
            $table->unsignedBigInteger('r04product_id');
            $table->foreign('r04product_id')->references('t04id')->on('t04productos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r04combo_product');
    }
};
