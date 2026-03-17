<?php

namespace App\Services;

use App\Models\Wishlist;

class WishlistService
{
    public function __construct(private readonly Wishlist $wishlist = new Wishlist())
    {
    }

    public function popularCount(): int
    {
        return 25;
    }
}
