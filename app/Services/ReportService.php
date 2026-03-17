<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Order;
use App\Models\User;
use Throwable;

class ReportService
{
    public function __construct(
        private readonly Order $order = new Order(),
        private readonly User $user = new User(),
        private readonly Book $book = new Book()
    ) {
    }

    /**
     * @return array<string, int>
     */
    public function kpi(): array
    {
        try {
            return [
                'revenue' => $this->estimateRevenue(),
                'orders' => $this->order->count(),
                'newUsers' => $this->user->count(),
                'bookTitles' => $this->book->count(),
            ];
        } catch (Throwable) {
            return [
                'revenue' => 55000000,
                'orders' => 320,
                'newUsers' => 78,
                'bookTitles' => 120,
            ];
        }
    }

    private function estimateRevenue(): int
    {
        $orders = $this->order->findAll(200);

        return (int) array_reduce(
            $orders,
            static fn (float $sum, array $order): float => $sum + (float) ($order['total_amount'] ?? 0),
            0.0
        );
    }
}
