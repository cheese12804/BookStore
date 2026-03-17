<?php

namespace App\Models;

use App\Core\Model;

class Category extends Model
{
    protected string $table = 'categories';

    protected array $fillable = ['name', 'slug', 'description', 'parent_id'];
}
