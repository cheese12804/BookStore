<?php

namespace App\Services;

use App\Models\Payment;
use Throwable;

class PaymentService
{
    public function __construct(private readonly Payment $payment = new Payment())
    {
    }

    /**
     * @return array<int, string>
     */
    public function availableMethods(): array
    {
        return ['COD', 'Bank Transfer', 'Momo'];
    }

    public function markAsPaid(int $orderId, string $method, string $transactionCode): int
    {
        if ($orderId <= 0 || $method === '' || $transactionCode === '') {
            return 0;
        }

        try {
            return $this->payment->create([
                'order_id' => $orderId,
                'method' => $method,
                'provider' => $method,
                'transaction_code' => $transactionCode,
                'status' => 'paid',
                'paid_at' => date('Y-m-d H:i:s'),
            ]);
        } catch (Throwable) {
            return 0;
        }
    }
}
