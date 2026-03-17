<?php

namespace App\Models;

use App\Core\Model;

class Notification extends Model
{
    protected string $table = 'notifications';

    protected array $fillable = ['user_id', 'title', 'message', 'type', 'is_read', 'read_at'];
}
