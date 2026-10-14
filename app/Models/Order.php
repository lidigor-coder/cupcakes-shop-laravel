<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['client_name', 'client_phone', 'cupcake_name', 'quantity', 'status'];
}
