<?php

namespace App\Models;

use App\Core\Model;

class Coupon extends Model
{
    protected string $table = 'coupons';

    protected array $fillable = ['code', 'type', 'value', 'min_order_value', 'start_at', 'end_at', 'is_active'];

    /**
     * @return array<string, mixed>|null
     */
    public function findActiveByCode(string $code): ?array
    {
        $sql = 'SELECT * FROM coupons WHERE code = ? AND is_active = 1 AND NOW() BETWEEN start_at AND end_at LIMIT 1';
        $stmt = $this->prepare($sql);
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result ? $result->fetch_assoc() : null;
        $stmt->close();

        return $row ?: null;
    }
}
