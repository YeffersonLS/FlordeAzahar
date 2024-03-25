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
        Schema::create('t02directorios', function (Blueprint $table) {
            $table->id('t02id');
			$table->text('t02nombre')->nullable();
			$table->timestamps(10);
			$table->text('t02grupo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t02directorios');
    }
};
