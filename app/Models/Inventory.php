<?php

namespace App\Models;

use App\Core\Model;

class Inventory extends Model
{
    protected string $table = 'inventories';

    protected array $fillable = ['book_id', 'warehouse_id', 'quantity', 'reserved'];

    /**
     * @return array<int, array<string, mixed>>
     */
    public function lowStock(int $threshold = 5): array
    {
        $sql = 'SELECT * FROM inventories WHERE quantity <= ? ORDER BY quantity ASC';
        $stmt = $this->prepare($sql);
        $stmt->bind_param('i', $threshold);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        $stmt->close();

        return $rows;
    }
}
