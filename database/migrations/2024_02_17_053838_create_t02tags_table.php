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
        Schema::create('t03tag', function (Blueprint $table) {
            $table->id('t03id');
            $table->string('t03nombre');
            $table->string('t03tipo');
            $table->bigInteger('t03usuario');
            $table->timestamps();
            $table->string('t03slug');
        });

        Schema::table('t03tag', function (Blueprint $table) {
            $table->foreign('t03usuario')->references('sys01id')->on('sys01usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t02tags');
    }
};
