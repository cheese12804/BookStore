<?php

namespace App\Models;

use App\Core\Model;

class Order extends Model
{
    protected string $table = 'orders';

    protected array $fillable = ['user_id', 'address_id', 'status', 'total_amount', 'payment_status', 'shipping_fee'];

    /**
     * @return array<int, array<string, mixed>>
     */
    public function findByUser(int $userId, int $limit = 10): array
    {
        $limit = max(1, $limit);
        $sql = 'SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC LIMIT ?';
        $stmt = $this->prepare($sql);
        $stmt->bind_param('ii', $userId, $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        $stmt->close();

        return $rows;
    }

    public function countByStatus(string $status): int
    {
        $sql = 'SELECT COUNT(*) as total FROM orders WHERE status = ?';
        $stmt = $this->prepare($sql);
        $stmt->bind_param('s', $status);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result ? $result->fetch_assoc() : null;
        $stmt->close();

        return (int) ($row['total'] ?? 0);
    }
}
