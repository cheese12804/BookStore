<?php

namespace App\Services;

use App\Models\Review;
use Throwable;

class ReviewService
{
    public function __construct(private readonly Review $review = new Review())
    {
    }

    public function averageRating(int $bookId = 0): float
    {
        if ($bookId <= 0) {
            return 4.7;
        }

        try {
            return $this->review->averageRatingForBook($bookId);
        } catch (Throwable) {
            return 4.7;
        }
    }
}
