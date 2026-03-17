<?php

namespace App\Models;

use App\Core\Model;

class Warehouse extends Model
{
    protected string $table = 'warehouses';

    protected array $fillable = ['name', 'address', 'contact_phone'];
}
