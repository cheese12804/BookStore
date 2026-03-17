<?php

namespace App\Services;

use App\Models\Shipment;

class ShipmentService
{
    public function __construct(private readonly Shipment $shipment = new Shipment())
    {
    }

    public function providers(): array
    {
        return ['GHN', 'GHTK', 'Viettel Post'];
    }
}
