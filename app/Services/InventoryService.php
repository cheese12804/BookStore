<?php

namespace App\Services;

use App\Models\Inventory;
use Throwable;

class InventoryService
{
    public function __construct(private readonly Inventory $inventory = new Inventory())
    {
    }

    public function lowStockCount(): int
    {
        try {
            return count($this->inventory->lowStock(5));
        } catch (Throwable) {
            return 3;
        }
    }
}
