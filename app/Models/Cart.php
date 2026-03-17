<?php

namespace App\Models;

use App\Core\Model;

class Cart extends Model
{
    protected string $table = 'carts';

    protected array $fillable = ['user_id', 'status', 'total_amount'];
}
