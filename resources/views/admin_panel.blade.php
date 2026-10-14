<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель заказов кондитерской</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f6f9; }
        h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #e83e8c; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .status-badge { background-color: #ffc107; color: #212529; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 12px; }
    </style>
</head>
<body>

    <h2>🧁 Панель администратора: Заказы на кексы</h2>
    
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
            
            <!-- Проверьте: строго $all_orders и строго закрывающие скобки ) -->
            @foreach($all_orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->client_name }}</td>
                    <td>{{ $order->client_phone }}</td>
                    <td><strong>{{ $order->cupcake_name }}</strong></td>
                    <td>{{ $order->quantity }}</td>
                    <td><span class="status-badge">{{ $order->status }}</span></td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                </tr>
            @endforeach
            
        </tbody>
    </table>

</body>
</html>
