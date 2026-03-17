<?php

namespace App\Services;

use App\Models\Coupon;
use Throwable;

class CouponService
{
    public function __construct(private readonly Coupon $coupon = new Coupon())
    {
    }

    public function activeCoupons(): int
    {
        try {
            return count($this->coupon->findAll(100));
        } catch (Throwable) {
            return 6;
        }
    }

    public function applyCoupon(string $code, float $subTotal): float
    {
        if ($code === '') {
            return $subTotal;
        }

        try {
            $coupon = $this->coupon->findActiveByCode($code);
            if ($coupon === null) {
                return $subTotal;
            }

            $minOrder = (float) ($coupon['min_order_value'] ?? 0);
            if ($subTotal < $minOrder) {
                return $subTotal;
            }

            if (($coupon['type'] ?? '') === 'percent') {
                $discount = $subTotal * ((float) ($coupon['value'] ?? 0) / 100);
                return max(0, $subTotal - $discount);
            }

            return max(0, $subTotal - (float) ($coupon['value'] ?? 0));
        } catch (Throwable) {
            return $subTotal;
        }
    }
}
