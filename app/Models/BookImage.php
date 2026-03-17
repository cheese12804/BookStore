<?php

namespace App\Models;

use App\Core\Model;

class BookImage extends Model
{
    protected string $table = 'book_images';

    protected array $fillable = ['book_id', 'image_url', 'is_primary'];
}
