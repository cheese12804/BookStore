<?php

namespace App\Models;

use App\Core\Model;

class Book extends Model
{
    protected string $table = 'books';

    protected array $fillable = [
        'title',
        'slug',
        'isbn',
        'author_id',
        'publisher_id',
        'category_id',
        'price',
        'stock',
        'description',
        'published_at',
    ];

    /**
     * @return array<int, array<string, mixed>>
     */
    public function searchByTitle(string $keyword, int $limit = 10): array
    {
        $limit = max(1, $limit);
        $sql = 'SELECT * FROM books WHERE title LIKE ? ORDER BY id DESC LIMIT ?';
        $stmt = $this->prepare($sql);
        $term = '%' . $keyword . '%';
        $stmt->bind_param('si', $term, $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        $stmt->close();

        return $rows;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function latest(int $limit = 8): array
    {
        $limit = max(1, $limit);
        $sql = 'SELECT * FROM books ORDER BY published_at DESC, id DESC LIMIT ?';
        $stmt = $this->prepare($sql);
        $stmt->bind_param('i', $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        $stmt->close();

        return $rows;
    }
}
