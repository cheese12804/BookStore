<?php

namespace App\Models;

use App\Core\Model;

class Shipment extends Model
{
    protected string $table = 'shipments';

    protected array $fillable = ['order_id', 'provider', 'tracking_code', 'status', 'shipped_at', 'delivered_at'];
}
