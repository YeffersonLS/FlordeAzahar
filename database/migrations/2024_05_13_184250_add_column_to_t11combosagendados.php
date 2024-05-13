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
        Schema::table('t11combosagendados', function (Blueprint $table) {
            $table->unsignedBigInteger('t11combo')->nullable();
            $table->foreign('t11combo')->references('t10id')->on('t10combos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t11combosagendados', function (Blueprint $table) {
            $table->dropColumn('t11combo');
        });
    }
};
