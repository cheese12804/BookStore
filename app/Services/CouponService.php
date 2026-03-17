<?php

namespace App\Services;

use App\Models\Coupon;

class CouponService
{
    public function __construct(private readonly Coupon $coupon = new Coupon())
    {
    }

    public function activeCoupons(): int
    {
        return 6;
    }
}
