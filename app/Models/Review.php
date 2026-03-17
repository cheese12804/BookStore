<?php

namespace App\Models;

use App\Core\Model;

class Review extends Model
{
    protected string $table = 'reviews';

    protected array $fillable = ['book_id', 'user_id', 'rating', 'comment', 'is_approved'];

    public function averageRatingForBook(int $bookId): float
    {
        $sql = 'SELECT AVG(rating) as avg_rating FROM reviews WHERE book_id = ? AND is_approved = 1';
        $stmt = $this->prepare($sql);
        $stmt->bind_param('i', $bookId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result ? $result->fetch_assoc() : null;
        $stmt->close();

        return round((float) ($row['avg_rating'] ?? 0), 1);
    }
}
