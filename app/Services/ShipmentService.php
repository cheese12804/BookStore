<?php

namespace App\Services;

use App\Models\Shipment;
use Throwable;

class ShipmentService
{
    public function __construct(private readonly Shipment $shipment = new Shipment())
    {
    }

    /**
     * @return array<int, string>
     */
    public function providers(): array
    {
        return ['GHN', 'GHTK', 'Viettel Post'];
    }

    public function createShipment(int $orderId, string $provider, string $trackingCode): int
    {
        if ($orderId <= 0 || $provider === '' || $trackingCode === '') {
            return 0;
        }

        try {
            return $this->shipment->create([
                'order_id' => $orderId,
                'provider' => $provider,
                'tracking_code' => $trackingCode,
                'status' => 'shipping',
                'shipped_at' => date('Y-m-d H:i:s'),
            ]);
        } catch (Throwable) {
            return 0;
        }
    }
}
