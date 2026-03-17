<?php

namespace App\Models;

use App\Core\Model;

class Payment extends Model
{
    protected string $table = 'payments';

    protected array $fillable = ['order_id', 'method', 'provider', 'transaction_code', 'status', 'paid_at'];
}
