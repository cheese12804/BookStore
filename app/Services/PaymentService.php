<?php

namespace App\Services;

use App\Models\Payment;

class PaymentService
{
    public function __construct(private readonly Payment $payment = new Payment())
    {
    }

    public function availableMethods(): array
    {
        return ['COD', 'Bank Transfer', 'Momo'];
    }
}
