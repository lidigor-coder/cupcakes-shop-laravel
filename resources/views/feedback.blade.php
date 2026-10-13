<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма на Laravel</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 50px;">

    <h2>Напишите нам (Laravel-версия)</h2>

    <!-- ПРОВЕРКА ВС ПЛЫВАЮЩЕГО СООБЩЕНИЯ -->
    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; width: 300px; border: 1px solid #c3e6cb;">
            <!-- Выводим текст из нашей сессии-вспышки -->
            {{ session('success') }}
        </div>
    @endif

    <!-- Форма отправляет данные методом POST на виртуальный адрес /send -->
    <form action="{{ url('/send') }}" method="POST">
        
        <!-- СЕКРЕТНЫЙ КЛЮЧ БЕЗОПАСНОСТИ LARAVEL -->
        @csrf
        
        <input type="text" name="username" placeholder="Ваше имя" required><br><br>
        <textarea name="user_message" placeholder="Сообщение" required></textarea><br><br>
        <button type="submit">Отправить</button>
    </form>

</body>
</html>
