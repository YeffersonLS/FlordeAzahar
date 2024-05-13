<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\Html\Column;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t11combosagendados', function (Blueprint $table) {
            $table->id('t11id');
            $table->string('t11nombre')->nullable();
            $table->bigInteger('t11numero')->nullable();
            $table->longText('t11direccion')->nullable();
            $table->string('t11hora')->nullable();
            $table->unsignedBigInteger('t11cliente')->nullable();
            $table->foreign('t11cliente')->references('sys01id')->on('sys01usuarios')->onDelete('cascade');
            $table->boolean('t11pago')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reve->default('text')rse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t11combosagendados');
    }
};
