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
        Schema::create('t09ventas', function (Blueprint $table) {
            $table->id('t09id');
            $table->unsignedBigInteger('t09usuario')->nullable();
            $table->foreign('t09usuario')->references('sys01id')->on('sys01usuarios')->onDelete('cascade');
            $table->unsignedBigInteger('t09cliente')->nullable();
            $table->foreign('t09cliente')->references('sys01id')->on('sys01usuarios')->onDelete('cascade');
            $table->float('t09valor')->nullable();
            $table->string('t09cupon')->nullable();
            $table->float('t09cuponvalor')->nullable();
            $table->unsignedBigInteger('t09detallemonedero')->nullable();
            $table->foreign('t09detallemonedero')->references('t08id')->on('t08detallemonederos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t09ventas');
    }
};
