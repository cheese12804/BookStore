<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function __construct(private readonly Category $category = new Category())
    {
    }

    public function all(): array
    {
        return ['Programming', 'Business', 'Self-help', 'Comics'];
    }
}
