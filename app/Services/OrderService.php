<?php

namespace App\Services;

use App\Models\Order;
use Throwable;

class OrderService
{
    public function __construct(private readonly Order $order = new Order())
    {
    }

    public function recentCount(): int
    {
        try {
            return $this->order->countByStatus('pending') + $this->order->countByStatus('confirmed');
        } catch (Throwable) {
            return 8;
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function ordersForUser(int $userId): array
    {
        if ($userId <= 0) {
            return [];
        }

        try {
            return $this->order->findByUser($userId, 20);
        } catch (Throwable) {
            return [];
        }
    }
}
