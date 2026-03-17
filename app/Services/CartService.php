<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use Throwable;

class CartService
{
    public function __construct(
        private readonly Cart $cart = new Cart(),
        private readonly CartItem $cartItem = new CartItem()
    ) {
    }

    public function totalItems(int $cartId = 0): int
    {
        if ($cartId <= 0) {
            return 0;
        }

        try {
            $items = $this->cartItem->findAll(200);
            $items = array_filter(
                $items,
                static fn (array $item): bool => (int) ($item['cart_id'] ?? 0) === $cartId
            );

            return array_reduce(
                $items,
                static fn (int $sum, array $item): int => $sum + (int) ($item['quantity'] ?? 0),
                0
            );
        } catch (Throwable) {
            return 0;
        }
    }
}
