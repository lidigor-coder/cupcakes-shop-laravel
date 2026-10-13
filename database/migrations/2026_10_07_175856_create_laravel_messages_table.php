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
        Schema::create('laravel_messages', function (Blueprint $table) {
            $table->id();
            // --- ДОПИСЫВАЕМ НАШИ ПОЛЯ ---
            $table->string('username'); // Это наш VARCHAR
            $table->text('user_message'); // Это наш TEXT
            // ----------------------------
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laravel_messages');
    }
};
