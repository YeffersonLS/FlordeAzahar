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
        Schema::create('t05postproductos', function (Blueprint $table) {
            $table->id('t05id');
            $table->unsignedBigInteger('t05producto')->unsigned();
            $table->foreign('t05producto')->references('t04id')->on('t04productos')->onDelete('cascade');
            $table->timestamps();
            $table->unsignedBigInteger('t05post');
            $table->foreign('t05post')->references('t01id')->on('t01blogs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t05postproductos');
    }
};
