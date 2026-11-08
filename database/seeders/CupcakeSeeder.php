<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// Обязательно подключаем нашу модель Cupcake!
use App\Models\Cupcake;

class CupcakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Наш массив с 9 кексами
        $cupcakes = [
            [
                'title' => 'Кремовый замок',
                'description' => 'Нежный крем любого цвета на выбор, вафельная основа',
                'price' => 150,
                'image' => 'creamy-castle.jpg', // имя вашей картинки
            ],
            [
                'title' => 'Малиновый рай',
                'description' => 'Воздушный бисквит с начинкой из спелой лесной малины',
                'price' => 170,
                'image' => 'raspberry-paradise.jpg', // подставьте ваше имя файла
            ],
            [
                'title' => 'Фейерверк',
                'description' => 'Воздушный бисквит с начинкой из спелой лесной малины',
                'price' => 170,
                'image' => 'firework.jpg', // подставьте ваше имя файла
            ],
            [
                'title' => 'Шоколадный мир',
                'description' => 'Нежный крем любого цвета на выбор, вафельная основа',
                'price' => 150,
                'image' => 'summer-fantasy.jpg', // имя вашей картинки
            ],
            [
                'title' => 'Слезы дракона',
                'description' => 'Плотный шоколадный бисквит с кусочками горького бельгийского шоколада',
                'price' => 190,
                'image' => 'dragon-tears.jpg', // подставьте ваше имя файла
            ],
            [
                'title' => 'Летняя фантазия',
                'description' => 'Нежный крем любого цвета на выбор, вафельная основа',
                'price' => 150,
                'image' => 'summer-fantasy.jpg', // имя вашей картинки
            ],
            [
                'title' => 'Мыс безумия',
                'description' => 'Воздушный бисквит с начинкой из спелой лесной малины',
                'price' => 170,
                'image' => 'madness-cape.jpg', // подставьте ваше имя файла
            ],
            [
                'title' => 'Облачная сказка',
                'description' => 'Плотный шоколадный бисквит с кусочками горького бельгийского шоколада',
                'price' => 190,
                'image' => 'dragon-tears.jpg', // подставьте ваше имя файла
            ],
            [
                'title' => 'Тёмный рыцарь',
                'description' => 'Плотный шоколадный бисквит с кусочками горького бельгийского шоколада',
                'price' => 190,
                'image' => 'dark-knight.jpg', // подставьте ваше имя файла
            ],
        ];

        // Крутим цикл и вставляем каждый кекс в базу данных через Модель
        foreach ($cupcakes as $cupcake) {
            Cupcake::create($cupcake);
        }
    }
}
