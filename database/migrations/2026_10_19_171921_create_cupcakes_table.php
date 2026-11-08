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
        Schema::create('cupcakes', function (Blueprint $table) {
            $table->id(); // Уникальный ID кекса

            // --- ПОЛОЧКИ ДЛЯ ДАННЫХ КЕКСА ---
            $table->string('title');        // Название (например: "Кремовый замок")
            $table->text('description');    // Описание десерта
            $table->integer('price');       // Цена (целое число, например: 150)
            $table->string('image');        // Имя файла картинки (например: "creamy-castle.jpg")
            // --------------------------------

            $table->timestamps(); // Время создания записи
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cupcakes');
    }
};
