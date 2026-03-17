<?php

namespace App\Services;

use App\Models\Cart;

class CartService
{
    public function __construct(private readonly Cart $cart = new Cart())
    {
    }

    public function totalItems(): int
    {
        return 0;
    }
}
