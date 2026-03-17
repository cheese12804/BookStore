<?php

namespace App\Services;

use App\Models\Category;
use Throwable;

class CategoryService
{
    public function __construct(private readonly Category $category = new Category())
    {
    }

    /**
     * @return array<int, string>
     */
    public function all(): array
    {
        try {
            $rows = $this->category->findAll(20);
            if ($rows !== []) {
                return array_map(
                    static fn (array $row): string => (string) ($row['name'] ?? 'N/A'),
                    $rows
                );
            }
        } catch (Throwable) {
        }

        return ['Programming', 'Business', 'Self-help', 'Comics'];
    }
}
