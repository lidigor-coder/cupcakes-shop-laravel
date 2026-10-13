<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Laravel Админка</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f6f9; }
        h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #28a745; color: white; } /* Сделаем её зеленой в стиле Laravel */
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>

    <h2>Панель администратора (Laravel Eloquent)</h2>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя пользователя</th>
                <th>Сообщение</th>
                <th>Дата отправки</th>
            </tr>
        </thead>
        <tbody>
            
            <!-- Магия Blade: крутим цикл прямо внутри HTML-тегов -->
            @foreach($all_messages as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <!-- Двойные скобочки сами защищают нас от XSS-атак, htmlspecialchars больше не нужен! -->
                    <td>{{ $row->username }}</td>
                    <td>{{ $row->user_message }}</td>
                    <!-- Поля времени Laravel умеет красиво форматировать через метод format() -->
                    <td>{{ $row->created_at->format('d.m.Y H:i') }}</td>
                </tr>
            @endforeach
            
        </tbody>
    </table>

</body>
</html>
