<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Подключаем нашу новую модель заказов кексов вместо старых сообщений!
use App\Models\Order;

class PageController extends Controller
{
    /**
     * 1. Метод показывает главную страницу кондитерской
     */
    public function showMainPage()
    {
        // Пока мы просто отдаем наш красивый HTML-макет кексов.
        // Чуть позже мы научим этот метод забирать товары из базы данных!
        return view('welcome');
    }

    /**
     * 2. Метод показывает админку для владельца кондитерской
     */
    public function showAdmin()
    {
        // Заменяем старую модель LaravelMessage на новую модель Order!
        // Вытаскиваем все заказы, самые свежие будут вверху таблицы
        $all_orders = Order::orderBy('id', 'desc')->get();

        // Передаем заказы в наш обновленный шаблон админки
        return view('admin_panel', compact('all_orders'));
    }

    /**
     * 3. Метод принимает и обрабатывает новый заказ кексов
     */
    public function handleForm(Request $request)
    {
        // --- ПЕРВАЯ ЛИНИЯ БИЗНЕС-ЛОГИКИ: ВАЛИДАЦИЯ ---
        // Мы просим Laravel автоматически проверить входящие данные из формы.
        // Если пользователь забудет указать телефон или введет слишком короткое имя,
        // Laravel сам прервет код и вернет человека назад с ошибкой!
        $validatedData = $request->validate([
            'client_name'  => 'required|min:2|max:100', // Имя обязательно, от 2 символов
            'client_phone' => 'required|min:7',         // Телефон обязателен
            'cupcake_name' => 'required',               // Название кекса обязательно
            'quantity'     => 'required|integer|min:1', // Количество — целое число, минимум 1 кекс
        ]);

        // --- ЗАПИСЬ НА СКЛАД MYSQL ---
        // Магия Eloquent ORM: передаем проверенные данные ($validatedData) в метод create.
        // Laravel сам выполнит безопасный SQL-запрос INSERT INTO orders...
        Order::create($validatedData);

        // Возвращаем покупателя обратно к макету кексов с зеленой плашкой успеха
        return back()->with('success', '🎂 Заказ успешно принят! Наш кондитер уже разогревает духовку. Ждите звонка!');
    }
}
