<?php

namespace App\Http\Controllers;

// Импортируем наш созданный Request и модель Order
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Профессиональный метод обработки заказа
     */
    public function store(StoreOrderRequest $request)
    {
        // Берем данные, которые УЖЕ успешно прошли проверку в StoreOrderRequest
        $validatedData = $request->validated();

        // Записываем безопасный заказ в базу данных MySQL
        Order::create($validatedData);

        // Возвращаем покупателя обратно с вашей красивой зеленой плашкой успеха!
        return back()->with('success', '🎂 Заказ успешно принят! Наш кондитер уже разогревает духовку. Ждите звонка!');
    }
}
