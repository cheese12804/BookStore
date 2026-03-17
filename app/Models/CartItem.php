<?php

namespace App\Models;

use App\Core\Model;

class CartItem extends Model
{
    protected string $table = 'cart_items';

    protected array $fillable = ['cart_id', 'book_id', 'quantity', 'unit_price'];
}
