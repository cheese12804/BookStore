<?php

namespace App\Services;

use App\Models\Book;
use Throwable;

class BookService
{
    public function __construct(private readonly Book $book = new Book())
    {
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function featured(): array
    {
        try {
            $books = $this->book->latest(6);
            if ($books !== []) {
                return $books;
            }
        } catch (Throwable) {
        }

        return [
            ['title' => 'Clean Code', 'price' => 199000, 'author' => 'Robert C. Martin'],
            ['title' => 'Refactoring', 'price' => 259000, 'author' => 'Martin Fowler'],
            ['title' => 'Design Patterns', 'price' => 289000, 'author' => 'GoF'],
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function search(string $keyword): array
    {
        if (trim($keyword) === '') {
            return [];
        }

        try {
            return $this->book->searchByTitle($keyword);
        } catch (Throwable) {
            return [];
        }
    }
}
