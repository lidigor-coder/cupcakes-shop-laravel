<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Главная страница кондитерской (наш макет кексов)
Route::get('/', [PageController::class, 'showMainPage']);

// Админка для просмотра заказов
Route::get('/admin-panel', [PageController::class, 'showAdmin']);

// Маршрут для отправки формы заказа (POST-запрос)
Route::post('/send-order', [PageController::class, 'handleForm']);
