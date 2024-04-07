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
        Schema::create('sys01usuarios', function (Blueprint $table) {
            $table->id('sys01id');
            $table->string('sys01fullname');
            $table->string('sys01name');
            $table->string('sys01middlename')->nullable();
            $table->string('sys01lastname');
            $table->string('sys01secondsurname')->nullable();
            $table->bigInteger('sys01phonenumber')->nullable();
            $table->boolean('sys01active')->default(false);
            $table->float('sys01nit')->nullable();
            $table->softDeletes();
            $table->string('sys01email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sys01usuarios');
    }
};
