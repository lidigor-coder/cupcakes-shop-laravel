<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Контакты</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 50px;">

    <h1>📞 Страница контактов</h1>
    
    <!-- Выводим «живые» переменные из Контроллера -->
    <p><b>Руководитель проекта:</b> {{ $managerName }}</p>
    <p><b>Электронная почта:</b> {{ $managerEmail }}</p>

    <hr>
    <footer style="margin-top: 50px; color: gray;">
        © {{ $currentYear }} Все права защищены.
    </footer>

</body>
</html>
