<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\PageController;

// Говорим: при запросе /contacts найди класс PageController и запусти в нем метод showContacts
Route::get('/contacts', [PageController::class, 'showContacts']);

// Показ формы (GET-запрос)
Route::get('/feedback', [PageController::class, 'showForm']);

// Прием данных (POST-запрос)
Route::post('/send', [PageController::class, 'handleForm']);

// Маршрут для нашей админки в Laravel
Route::get('/admin-panel', [PageController::class, 'showAdmin']);
