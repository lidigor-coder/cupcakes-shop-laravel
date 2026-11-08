<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderController;
// 1. Импортируем контроллер управления кексами
use App\Http\Controllers\CupcakeController;

Route::get('/', [PageController::class, 'showMainPage']);
Route::get('/admin-panel', [PageController::class, 'showAdmin']);
Route::post('/send-order', [OrderController::class, 'store'])->name('orders.store');

// 2. ОДНА СТРОКА ДЛЯ ВСЕГО CRUD (Create, Read, Update, Delete) КЕКСОВ
Route::resource('admin/cupcakes', CupcakeController::class);
