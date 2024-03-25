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
        Schema::create('t06banners', function (Blueprint $table) {
            $table->id('t06id');
            $table->string('t06image_path');
            $table->string('t06descripcionimagen');
            $table->boolean('t06publicado')->nullable()->default(false);
            $table->integer('t06orden')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t06banners');
    }
};
