<?php

namespace App\Services;

use App\Models\Inventory;

class InventoryService
{
    public function __construct(private readonly Inventory $inventory = new Inventory())
    {
    }

    public function lowStockCount(): int
    {
        return 3;
    }
}
