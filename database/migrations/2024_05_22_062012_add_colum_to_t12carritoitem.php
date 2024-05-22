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
        Schema::table('t12carritoitems', function (Blueprint $table) {
            $table->boolean('t12pedido')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t12carritoitems', function (Blueprint $table) {
            $table->dropColumn('t12pedido');
        });
    }
};
