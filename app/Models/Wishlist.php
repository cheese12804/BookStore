<?php

namespace App\Models;

use App\Core\Model;

class Wishlist extends Model
{
    protected string $table = 'wishlists';

    protected array $fillable = ['user_id', 'book_id', 'created_at'];
}
