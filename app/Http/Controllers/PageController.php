<?php

namespace App\Http\Controllers;

// Обратите внимание: плагин больше не будет подчеркивать Request, 
// так как мы используем его ниже в методе handleForm!
use Illuminate\Http\Request;
// --- ВОТ ЭТА СТРОЧКА ИСПРАВИТ ОШИБКУ И ПОДЧЕРКИВАНИЕ! ---
use App\Models\LaravelMessage;

class PageController extends Controller
{
    // 1. Старый метод для страницы контактов (оставляем его здесь)
    public function showContacts()
    {
        $managerName = 'Игорь Глазков';
        $managerEmail = 'lidigor63@gmail.com';
        $currentYear = date('Y');

        return view('contacts', compact('managerName', 'managerEmail', 'currentYear'));
    } // <-- Проверьте, чтобы эта скобка закрывала метод контактов!

    // 2. Метод, который просто показывает нашу форму
    public function showForm()
    {
        return view('feedback');
    } // shadow-скобка закрывает метод показа формы

    // 3. Метод, который принимает данные из формы
    public function handleForm(Request $request)
{
    // 1. Забираем данные из полей формы
    $name = $request->input('username');
    $message = $request->input('user_message');

    // 2. ВОТ ЭТА СТРОЧКА ЗАПИШЕТ ДАННЫЕ В БАЗУ MYSQL (XAMPP)!
    // Метод create сам сделает SQL-запрос INSERT INTO laravel_messages...
    LaravelMessage::create([
        'username' => $name,
        'user_message' => $message,
    ]);

    // 3. Делаем красивый редирект назад с зеленой плашкой
    return back()->with('success', "Спасибо, $name! Ваше сообщение успешно сохранено в базу данных через Eloquent ORM!");
}

    // 4. Метод для показа админки в Laravel
    public function showAdmin()
    {
        // Магия Eloquent! Заменяет весь старый SQL-запрос SELECT * FROM...
        // get() — выполняет запрос и превращает результат в удобную коллекцию (массив объектов)
        $all_messages = LaravelMessage::orderBy('id', 'desc')->get();

        // Передаем эти сообщения в будущий шаблон admin_panel.blade.php
        return view('admin_panel', compact('all_messages'));
    }
} // <-- САМАЯ ПОСЛЕДНЯЯ СКОБКА: она закрывает весь класс PageController!
