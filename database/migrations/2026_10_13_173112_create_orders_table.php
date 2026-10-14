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
    Schema::create('orders', function (Blueprint $table) {
        $table->id(); // Номер заказа
        
        // --- ПОЛОЧКИ ДЛЯ КОНДИТЕРСКОЙ ---
        $table->string('client_name');    // Имя покупателя
        $table->string('client_phone');   // Телефон для связи
        $table->string('cupcake_name');   // Какой кекс заказал (например: "Шоколадный взрыв")
        $table->integer('quantity');      // Сколько штук заказал (целое число INT)
        $table->string('status')->default('Новый'); // Статус заказа (по умолчанию — "Новый")
        // --------------------------------
        
        $table->timestamps(); // Время заказа
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
