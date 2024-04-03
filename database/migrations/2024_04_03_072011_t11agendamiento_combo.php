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
        Schema::create('t11agendamiento_combo', function (Blueprint $table) {
            $table->bigIncrements('t11id');
            $table->unsignedBigInteger('t11combo');
            $table->foreign('t11combo')->references('t10id')->on('t10combos')->onDelete('cascade');
            $table->time('t11hora');
            $table->unsignedBigInteger('t11usuario')->nullable();
            $table->foreign('t11usuario')->references('sys01id')->on('sys01usuarios')->onDelete('cascade');
            $table->timestamps();
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
