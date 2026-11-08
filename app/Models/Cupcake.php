<?php

namespace App\Models;

// Проверьте, чтобы эта строчка импорта была на месте
use Illuminate\Database\Eloquent\Model;

// Класс ОБЯЗАН расширять (extends) базовую модель Laravel!
class Cupcake extends Model
{
    // Указываем имя таблицы в MySQL
    protected $table = 'cupcakes';

    // Разрешаем массово заполнять эти поля в базе данных
    protected $fillable = ['title', 'description', 'price', 'image'];
}
