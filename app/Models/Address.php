<?php

namespace App\Models;

use App\Core\Model;

class Address extends Model
{
    protected string $table = 'addresses';

    protected array $fillable = ['user_id', 'full_name', 'phone', 'street', 'ward', 'district', 'city', 'is_default'];
}
