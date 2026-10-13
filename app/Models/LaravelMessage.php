<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaravelMessage extends Model
{
    // Указываем имя нашей таблицы в MySQL (XAMPP), чтобы модель точно знала, куда писать
    protected $table = 'laravel_messages';

    // Разрешаем форме заполнять эти поля
    protected $fillable = ['username', 'user_message'];
}
