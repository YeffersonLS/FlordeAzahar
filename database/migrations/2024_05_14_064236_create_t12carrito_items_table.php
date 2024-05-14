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
        Schema::create('t12carritoitems', function (Blueprint $table) {
            $table->id('t12id');
            $table->unsignedBigInteger('t12producto')->nullable();
            $table->foreign('t12producto')->references('t04id')->on('t04productos')->onDelete('cascade');
            $table->bigInteger('t12cantidad')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t12carrito_items');
    }
};
