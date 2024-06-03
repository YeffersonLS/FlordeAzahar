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
        Schema::table('t14pedidos', function (Blueprint $table) {
            $table->string('t14paga')->nullable();
            $table->string('t14cambio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t14pedidos', function (Blueprint $table) {
            $table->dropColumn('t14paga');
            $table->dropColumn('t14cambio');
        });
    }
};
