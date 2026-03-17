<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function __construct(private readonly Order $order = new Order())
    {
    }

    public function recentCount(): int
    {
        return 8;
    }
}
