<?php

namespace App\Models;

use App\Core\Model;

class OrderItem extends Model
{
    protected string $table = 'order_items';

    protected array $fillable = ['order_id', 'book_id', 'quantity', 'unit_price', 'discount_amount'];
}
