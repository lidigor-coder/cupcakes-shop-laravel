<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Продажа кексов</title>
</head>
<body>

@if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
        {{ session('success') }}
    </div>
@endif


    <!-- 1. Указываем action на наш новый роут и метод POST -->
<form action="{{ url('/send-order') }}" method="POST">
    
    <!-- 2. ОБЯЗАТЕЛЬНО СТАВИМ КЛЮЧ БЕЗОПАСНОСТИ LARAVEL -->
    @csrf

    <!-- 3. Проверьте атрибуты name у полей! Они должны строго совпадать с нашей валидацией в контроллере -->
    
    <!-- Поле имени клиента -->
    <input type="text" name="client_name" placeholder="Ваше имя" required>

    <!-- Поле телефона -->
    <input type="text" name="client_phone" placeholder="Номер телефона" required>

    <!-- Выбор кекса (это может быть обычный input или выпадающий список select) -->
    <!-- Главное, чтобы у него был атрибут name="cupcake_name" -->
    <input type="text" name="cupcake_name" placeholder="Название кекса (например, Ванильный)" required>

    <!-- Количество кексов -->
    <input type="number" name="quantity" value="1" min="1" required>

    <button type="submit">Оформить заказ на кексы</button>
</form>


</body>
</html>
