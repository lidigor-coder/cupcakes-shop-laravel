<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель кондитерской 🎂</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 40px 20px;
            color: #333;
        }

        .admin-container {
            max-width: 1100px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        h1 {
            margin-top: 0;
            color: #2c3e50;
            font-size: 28px;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 15px;
        }

        /* Стили вкладок (Табов) */
        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
        }

        .tab-btn {
            padding: 10px 25px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            background: #e2e8f0;
            color: #64748b;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
        }

        .tab-btn.active {
            background: #ff6b81;
            color: white;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Таблицы и формы */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background-color: #f8fafc;
            color: #64748b;
            font-size: 12px;
            text-transform: uppercase;
        }

        .status-badge {
            background-color: #ffeaa7;
            color: #d63031;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-group input,
        .form-group textarea {
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            color: white;
        }

        .btn-success {
            background: #2c3e50;
        }

        .btn-danger {
            background: #d63031;
            padding: 6px 12px;
            font-size: 12px;
        }

        .alert {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>

<body>

    <div class="admin-container">
        <h1>Панель управления кондитерской</h1>

        <!-- Уведомления об успехе CRUD кексов -->
        @if (session('success_cupcake'))
            <div class="alert">{{ session('success_cupcake') }}</div>
        @endif

        <!-- Переключатели вкладок -->
        <div class="tabs">
            <button class="tab-btn active" onclick="openTab(event, 'orders-tab')">Заказы клиентов
                ({{ $all_orders->count() }})</button>
            <button class="tab-btn" onclick="openTab(event, 'cupcakes-tab')">Управление каталогом
                ({{ $all_cupcakes->count() }})</button>
        </div>

        <!-- ВКЛАДКА 1: ЗАКАЗЫ -->
        <div id="orders-tab" class="tab-content active">
            <table>
                <thead>
                    <tr>
                        <th>№ Заказа</th>
                        <th>Имя клиента</th>
                        <th>Телефон</th>
                        <th>Название кекса</th>
                        <th>Количество (шт)</th>
                        <th>Статус</th>
                        <th>Время заказа</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->client_name }}</td>
                            <td><a href="tel:{{ $order->client_phone }}">{{ $order->client_phone }}</a></td>
                            <td><strong>{{ $order->cupcake_name }}</strong></td>
                            <td>{{ $order->quantity }} шт</td>
                            <td><span class="status-badge">{{ $order->status ?? 'Новый' }}</span></td>
                            <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- ВКЛАДКА 2: КЕКСЫ (CRUD) -->
        <div id="cupcakes-tab" class="tab-content">
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px;">

                <!-- Список кексов с кнопкой удаления -->
                <div>
                    <h3>Текущие товары в базе данных</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Фото</th>
                                <th>Название</th>
                                <th>Цена</th>
                                <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_cupcakes as $cake)
                                <tr>
                                    <td><img src="{{ asset('storage/cupcakes/' . $cake->image) }}" width="50"
                                            height="50" style="object-fit: cover; border-radius: 6px;"></td>
                                    <td><strong>{{ $cake->title }}</strong></td>
                                    <td>{{ $cake->price }} BYN</td>
                                    <td>
                                        <!-- Профессиональное удаление через форму POST + метод DELETE -->
                                        <form action="{{ route('cupcakes.destroy', $cake->id) }}" method="POST"
                                            onsubmit="return confirm('Вы уверены, что хотите удалить этот кекс?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Форма добавления нового кекса (CREATE) -->
                <div style="background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;">
                    <h3>Добавить новый кекс</h3>
                    <!-- ОБЯЗАТЕЛЬНО: enctype="multipart/form-data" для загрузки файлов -->
                    <form action="{{ route('cupcakes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Название кекса:</label>
                            <input type="text" name="title" required placeholder="Например: Черничное чудо">
                        </div>
                        <div class="form-group">
                            <label>Цена (BYN):</label>
                            <input type="number" step="0.01" name="price" required placeholder="5.50">
                        </div>
                        <div class="form-group">
                            <label>Описание:</label>
                            <textarea name="description" rows="3" required placeholder="Опишите вкус кекса..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Фотография кекса:</label>
                            <input type="file" name="image" required accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-success" style="width: 100%; margin-top: 10px;">Загрузить
                            в магазин</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Маленький JS для переключения вкладок без перезагрузки -->
    <script>
        function openTab(evt, tabName) {
            const tabcontents = document.getElementsByClassName("tab-content");
            for (let i = 0; i < tabcontents.length; i++) {
                tabcontents[i].style.display = "none";
            }
            const tablinks = document.getElementsByClassName("tab-btn");
            for (let i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.classList.add("active");
        }
    </script>

</body>

</html>
