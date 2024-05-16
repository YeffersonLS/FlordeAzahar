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
        Schema::create('t14pedidos', function (Blueprint $table) {
            $table->id('t14id');
            $table->unsignedBigInteger('t14cliente')->nullable();
            $table->foreign('t14cliente')->references('sys01id')->on('sys01usuarios')->onDelete('cascade');
            $table->boolean('t14pago')->nullable()->default(false);
            $table->mediumText('t14direccion')->nullable();
            $table->string('t14tipopago')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t14pedidos');
    }
};
