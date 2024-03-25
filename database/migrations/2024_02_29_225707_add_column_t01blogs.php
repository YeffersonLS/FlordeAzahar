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
        Schema::table('t01blogs', function (Blueprint $table) {
            $table->bigInteger('t01postproducto')->nullable();
            $table->foreign('t01postproducto')->references('t05id')->on('t05postproductos')->onDelete('cascade');
            $table->boolean('t01producto')->nullable()->default(false);
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
