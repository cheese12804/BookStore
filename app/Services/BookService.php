<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    public function __construct(private readonly Book $book = new Book())
    {
    }

    public function featured(): array
    {
        return [
            ['title' => 'Clean Code', 'price' => 199000, 'author' => 'Robert C. Martin'],
            ['title' => 'Refactoring', 'price' => 259000, 'author' => 'Martin Fowler'],
            ['title' => 'Design Patterns', 'price' => 289000, 'author' => 'GoF'],
        ];
    }
}
