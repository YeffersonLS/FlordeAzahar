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
        Schema::create('t13carritos', function (Blueprint $table) {
            $table->id('t13id');
            $table->unsignedBigInteger('t13cliente')->nullable();
            $table->foreign('t13cliente')->references('sys01id')->on('sys01usuarios')->onDelete('cascade');
            $table->bigInteger('t13sessionid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t13carritos');
    }
};
