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
        Schema::create('t01blogs', function (Blueprint $table) {
            $table->id('t01id');
            $table->unsignedBigInteger('t01usuario');
            $table->longText('t01descripcion')->nullable();
            $table->longText('t01contenido')->nullable();
            $table->longText('t01nombre');
            $table->longText('t01tituloseo')->nullable();
            $table->integer('t01views')->default(0);
            $table->integer('t01comments')->default(0);
            $table->timestamps();
            $table->text('t01metadescription')->nullable();
            $table->unsignedBigInteger('t01categoria')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t01blogs');
    }
};
