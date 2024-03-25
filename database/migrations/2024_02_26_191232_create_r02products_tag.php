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
        Schema::create('r02products_tag', function (Blueprint $table) {
            $table->id('r02id');
            $table->unsignedBigInteger('r02product_id');
            $table->foreign('r02product_id')->references('t04id')->on('t04productos')->onDelete('cascade');
            $table->unsignedBigInteger('r02tag_id');
            $table->foreign('r02tag_id')->references('t03id')->on('t03tag')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['r02product_id', 'r02tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r02products_tag');
    }
};
