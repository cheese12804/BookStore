<?php

namespace App\Models;

use App\Core\Model;

class Author extends Model
{
    protected string $table = 'authors';

    protected array $fillable = ['name', 'biography', 'avatar', 'birth_date'];
}
