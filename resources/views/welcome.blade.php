<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог капкейков</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Декоративные элементы -->
    <div class="deco-berry deco-berry-1"></div>
    <div class="deco-leaf deco-leaf-1"></div>
    <div class="deco-leaf deco-leaf-2"></div>

    <section class="catalog">
        <div class="container">
            <h2 class="section-title">Для любых событий и дорогих вам людей</h2>

            <div class="cards-grid">

                <!-- Открываем цикл Blade: для каждого кекса из переменной $all_cupcakes как $cupcake -->
                @foreach ($all_cupcakes as $cupcake)
                    <div class="product-card">
                        <!-- 1. Живая картинка. Склеиваем путь к папке public/images/ и имя файла из базы -->
                        <img src="{{ asset('images/' . $cupcake->image) }}" alt="{{ $cupcake->title }}"
                            class="card-image">

                        <!-- 2. Живое название кекса -->
                        <h3>{{ $cupcake->title }}</h3>

                        <!-- 3. Живое описание кекса -->
                        <p>{{ $cupcake->description }}</p>

                        <!-- 4. Живая цена -->
                        <div class="price">{{ $cupcake->price }} Р/шт.</div>

                        <!-- Перепроверьте эту строчку в карточке кекса -->
                        <button class="btn-order js-buy-btn" data-name="{{ $cupcake->title }}">Заказать</button>

                    </div>
                @endforeach <!-- Обязательно закрываем цикл! -->

            </div>
        </div>
    </section>
    <section class="order">
        <div class="container">



            <!-- УМНАЯ ЗЕЛЕНАЯ ПЛАШКА УСПЕХА ПО ЦЕНТРУ ЭКРАНА -->
            @if (session('success'))
                <div id="success-alert-overlay"
                    style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 10000; display: flex; justify-content: center; align-items: center; backdrop-filter: blur(3px);">

                    <div
                        style="background: white; padding: 30px; border-radius: 12px; width: 100%; max-width: 450px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.2); border-top: 5px solid #28a745; font-family: sans-serif; animation: scaleUp 0.3s ease;">

                        <!-- Большая сочная иконка успеха -->
                        <div style="font-size: 50px; margin-bottom: 15px;">🎂</div>

                        <h3 style="margin-top: 0; color: #155724; font-size: 22px; font-weight: bold;">Заказ принят!
                        </h3>

                        <!-- Текст сообщения из вашего контроллера -->
                        <p
                            style="color: #555; font-size: 16px; line-height: 1.5; margin-bottom: 25px; padding: 0 10px;">
                            {{ session('success') }}
                        </p>

                        <!-- Кнопка закрытия плашки -->
                        <button onclick="document.getElementById('success-alert-overlay').remove()"
                            style="background: #28a745; color: white; border: none; padding: 12px 35px; font-size: 16px; font-weight: bold; border-radius: 6px; cursor: pointer; transition: background 0.2s; width: 100%;">
                            Отлично, жду!
                        </button>

                    </div>
                </div>

                <!-- Маленькая плавная анимация появления -->
                <style>
                    @keyframes scaleUp {
                        from {
                            transform: scale(0.8);
                            opacity: 0;
                        }

                        to {
                            transform: scale(1);
                            opacity: 1;
                        }
                    }
                </style>
            @endif



            <!-- ТЕХНИЧЕСКАЯ ОБЕРТКА-ЗАТЕМНЕНИЕ (По умолчанию скрыта: display: none) -->
            <div id="order-modal"
                style="display: {{ $errors->any() ? 'flex' : 'none' }}; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 9999; justify-content: center; align-items: center; backdrop-filter: blur(4px);">

                <!-- КНОПКА ЗАКРЫТИЯ ОКНА (Крестик) — профессионально добавлять его в верхний угол -->
                <button id="close-modal-btn"
                    style="position: absolute; top: 20px; right: 25px; background: none; border: none; font-size: 35px; cursor: pointer; color: white;">&times;</button>

                <!-- ВАША КРАСИВАЯ БЕЛАЯ КАРТОЧКА ИЗ МАКЕТА -->
                <div
                    style="background: white; padding: 40px; border-radius: 12px; width: 100%; max-width: 800px; box-shadow: 0 10px 30px rgba(0,0,0,0.15); text-align: center; font-family: sans-serif; position: relative;">

                    <h2 style="font-size: 28px; color: #222; margin-top: 0; font-weight: bold;">Чтобы сделать заказ,
                        укажите ваш телефон</h2>
                    <p style="color: #666; font-size: 16px; margin-bottom: 5px;">Мы перезвоним в течение 15 минут, чтобы
                        уточнить ваши пожелания</p>

                    <!-- Дополнительная строчка для прозрачности: показывает, какой товар выбран -->
                    <p style="font-size: 15px; color: #888; margin-bottom: 25px;">
                        Вы заказываете: <strong id="modal-cupcake-title" style="color: #ffb703;">Кекс не выбран</strong>
                    </p>

                    <!-- ВЫВОД ОШИБОК ВАЛИДАЦИИ (если телефон ввели неверно) -->
                    @if ($errors->any())
                        <div
                            style="background-color: #f8d7da; color: #721c24; padding: 10px; margin: 0 auto 20px auto; max-width: 500px; border-radius: 6px; font-size: 14px; text-align: left;">
                            @foreach ($errors->all() as $error)
                                <div>• {{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <!-- НАЧАЛО ВАШЕЙ ФОРМЫ -->
                    <form action="{{ route('orders.store') }}" method="POST" id="order-form-section"
                        style="display: flex; flex-direction: column; align-items: center;">
                        @csrf

                        <!-- Скрытые системные поля (передаются незаметно для юзера) -->
                        <input type="hidden" id="cupcake_field" name="cupcake_name" value="{{ old('cupcake_name') }}"
                            required>
                        <input type="hidden" name="client_name" value="Анонимный покупатель">
                        <input type="hidden" name="quantity" value="1">

                        <!-- Ряд с вводом и кнопкой (как на вашем скриншоте) -->
                        <div
                            style="display: flex; gap: 15px; width: 100%; max-width: 600px; justify-content: center; margin-bottom: 15px;">

                            <!-- Поле телефона -->
                            <input type="text" name="client_phone" value="{{ old('client_phone') }}"
                                placeholder="Номер телефона" required
                                style="flex: 1; padding: 15px 20px; background: #f0f3f7; border: none; border-radius: 8px; font-size: 16px; outline: none;">

                            <!-- Желтая кнопка отправить -->
                            <button type="submit"
                                style="padding: 15px 40px; background: #ffcc00; color: #222; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background 0.2s;">
                                Сделать заказ
                            </button>

                        </div>

                        <!-- Чекбокс согласия (маленький текст внизу) -->
                        <label
                            style="font-size: 12px; color: #888; display: flex; align-items: center; gap: 5px; cursor: pointer;">
                            <input type="checkbox" checked required style="accent-color: #007bff;">
                            Нажимая на кнопку, вы соглашаетесь с условиями обработки персональных данных
                        </label>

                    </form>
                </div>
            </div>



        </div>
    </section>

    <!-- Оборачиваем весь цикл в контейнер галереи -->

    <style>
        /* Контейнер-сетка для всей галереи товаров */
        .cupcakes-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Стиль индивидуальной карточки кекса */
        .cupcake-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border: 1px solid #f0f0f0;
        }

        /* Эффект при наведении на карточку */
        .cupcake-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Ограничение размеров картинки кекса */
        .cupcake-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            /* Картинка заполнит область без искажения пропорций */
            border-radius: 12px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
            /* Фон на случай, если картинка долго грузится */
        }

        /* Заголовки и тексты */
        .cupcake-card h3 {
            font-size: 18px;
            color: #333333;
            margin: 10px 0;
            font-family: sans-serif;
        }

        .cupcake-card .description {
            font-size: 14px;
            color: #777777;
            line-height: 1.4;
            margin-bottom: 15px;
            flex-grow: 1;
            /* Толкает цену и кнопку вниз, чтобы карточки были одинаковой высоты */
        }

        .cupcake-card .price {
            font-size: 20px;
            font-weight: bold;
            color: #ff6b81;
            /* Приятный розовый цвет для цены */
            margin-bottom: 15px;
        }

        /* Кнопка "Заказать" внутри карточки */
        .cupcake-card .btn-order {
            background: #ffcc00;
            color: #222222;
            border: none;
            padding: 12px 25px;
            font-size: 15px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.2s;
            width: 100%;
        }

        .cupcake-card .btn-order:hover {
            background: #e6b800;
        }
    </style>



    <div class="cupcakes-gallery">
        @foreach ($all_cupcakes as $cupcake)
            <div class="cupcake-card">
                <img src="{{ asset('storage/cupcakes/' . $cupcake->image) }}" alt="{{ $cupcake->title }}">
                <h3>{{ $cupcake->title }}</h3>
                <p class="description">{{ $cupcake->description }}</p>
                <p class="price">{{ $cupcake->price }} BYN</p>
                <button class="btn-order js-buy-btn" data-name="{{ $cupcake->title }}">Заказать</button>
            </div>
        @endforeach
    </div>


    <!-- СЕКЦИЯ 2: ВИЗУАЛЬНАЯ ГАЛЕРЕЯ (ФУТЕР / ИНСТА-ВИД) -->
    <h2 class="section-title">Галерея кондитерской</h2>
    <div class="cupcakes-visual-gallery">
        @foreach ($all_cupcakes as $cupcake)
            <div class="gallery-item">
                <img src="{{ asset('storage/cupcakes/' . $cupcake->image) }}" alt="{{ $cupcake->title }}"
                    class="gallery-img">
                <div class="gallery-overlay">
                    <span>{{ $cupcake->title }}</span>
                </div>
            </div>
        @endforeach
    </div>


    <style>
        /* Стили для нижней визуальной галереи */
        .cupcakes-visual-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 15px;
            /* Меньше отступы между фото */
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto 50px auto;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            height: 220px;
            /* Фиксированная высота для ровной сетки */
            cursor: pointer;
        }

        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        /* Эффект красивого увеличения фото при наведении */
        .gallery-item:hover .gallery-img {
            transform: scale(1.1);
        }

        /* Всплывающее название кекса при наведении на фото */
        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 107, 129, 0.8);
            /* Фирменный розовый фон с прозрачностью */
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
            opacity: 0;
            transition: opacity 0.3s ease;
            font-family: sans-serif;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
    </style>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buyButtons = document.querySelectorAll('.js-buy-btn');
            const modal = document.getElementById('order-modal');
            const closeModalBtn = document.getElementById('close-modal-btn');

            const cupcakeField = document.getElementById('cupcake_field');
            const modalCupcakeTitle = document.getElementById('modal-cupcake-title');

            // Если на странице вернулись ошибки валидации, восстанавливаем текст выбранного кекса из сессии старого ввода
            @if ($errors->any() && old('cupcake_name'))
                modalCupcakeTitle.textContent = "{{ old('cupcake_name') }}";
            @endif

            // Открытие поп-апа при клике на "Заказать"
            buyButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    const cupcakeName = this.getAttribute('data-name');

                    if (cupcakeName) {
                        // 1. Записываем имя в скрытое поле для Laravel
                        cupcakeField.value = cupcakeName;
                        // 2. Записываем имя в текстовую плашку для пользователя
                        modalCupcakeTitle.textContent = cupcakeName;
                        // 3. Показываем поп-ап
                        modal.style.display = 'flex';
                    }
                });
            });

            // Закрытие поп-апа при клике на крестик
            closeModalBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            // Закрытие поп-апа при клике на темную область вокруг окна
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>

</body>

</html>
