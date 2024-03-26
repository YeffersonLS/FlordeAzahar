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
        Schema::create('t07monederos', function (Blueprint $table) {
            $table->id('t07id');
            $table->unsignedBigInteger('t07usuario')->unsigned();
            $table->foreign('t07usuario')->references('sys01id')->on('sys01usuarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t07monederos');
    }
};
