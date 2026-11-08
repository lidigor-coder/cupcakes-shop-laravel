<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cupcake;

class PageController extends Controller
{
    /**
     * 1. Метод показывает главную страницу кондитерской
     */
    public function showMainPage()
    {
        // Забираем ВСЕ кексы из таблицы cupcakes
        $all_cupcakes = Cupcake::all();

        // Передаем переменную в макет welcome.blade.php
        return view('welcome', compact('all_cupcakes'));
    }

    /**
     * 2. Метод показывает админку для владельца кондитерской
     */
    public function showAdmin()
    {
        // Забираем и заказы, и кексы
        $all_orders = Order::orderBy('id', 'desc')->get();
        $all_cupcakes = Cupcake::orderBy('id', 'desc')->get();

        // Передаем обе переменные в шаблон админки
        return view('admin_panel', compact('all_orders', 'all_cupcakes'));
    }
}
