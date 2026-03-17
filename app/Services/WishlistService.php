<?php

namespace App\Services;

use App\Models\Wishlist;
use Throwable;

class WishlistService
{
    public function __construct(private readonly Wishlist $wishlist = new Wishlist())
    {
    }

    public function popularCount(): int
    {
        try {
            return $this->wishlist->count();
        } catch (Throwable) {
            return 25;
        }
    }
}
