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
        Schema::create('t04productos', function (Blueprint $table) {
            $table->id('t04id');
            $table->string('t04nombre')->nullable();
            $table->string('t04presentacion')->nullable();
            $table->string('t04cantidad')->nullable();  //gr
            $table->unsignedBigInteger('t04usuario')->nullable();
            $table->foreign('t04usuario')->references('sys01id')->on('sys01usuarios');
            $table->boolean('t04activo')->nullable()->default(false);
            $table->text('t04descripcion')->nullable();
            $table->string('t04sabor')->nullable();
            $table->unsignedBigInteger('t04categoria')->nullable();
            $table->foreign('t04categoria')->references('t02id')->on('t02directorios');
            $table->timestamps();
            $table->longText('t04preparacion')->nullable();
            $table->string('t04slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t04productos');
    }
};
