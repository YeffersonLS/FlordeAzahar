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
        Schema::create('t08detallemonederos', function (Blueprint $table) {
            $table->id('t08id');
            $table->bigInteger('t08venta')->nullable();
            $table->float('t08valor')->nullable();
            $table->bigInteger('t08monedero')->nullable();
            $table->foreign('t08monedero')->references('t07id')->on('t07monederos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t08detallemonederos');
    }
};
