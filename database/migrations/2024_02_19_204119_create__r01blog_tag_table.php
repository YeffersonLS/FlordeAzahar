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
        Schema::create('r01blog_tag', function (Blueprint $table) {
            $table->id('r01id');
            $table->unsignedBigInteger('r01blog_id');
            $table->foreign('r01blog_id')->references('t01id')->on('t01blogs')->onDelete('cascade');
            $table->unsignedBigInteger('r01tag_id');
            $table->foreign('r01tag_id')->references('t03id')->on('t03tag')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['r01blog_id', 'r01tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r01blog_tag');
    }
};
