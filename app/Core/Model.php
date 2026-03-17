<?php

namespace App\Core;

use mysqli;
use mysqli_stmt;
use RuntimeException;

abstract class Model
{
    protected string $table = '';

    /**
     * @var array<int, string>
     */
    protected array $fillable = [];

    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function findAll(int $limit = 50): array
    {
        $limit = max(1, $limit);
        $sql = sprintf('SELECT * FROM %s LIMIT %d', $this->table, $limit);
        $result = $this->db()->query($sql);

        if (!$result) {
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * @return array<string, mixed>|null
     */
    public function findById(int $id): ?array
    {
        $sql = sprintf('SELECT * FROM %s WHERE id = ? LIMIT 1', $this->table);
        $stmt = $this->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result ? $result->fetch_assoc() : null;
        $stmt->close();

        return $row ?: null;
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): int
    {
        $filtered = $this->filterFillable($data);
        if ($filtered === []) {
            return 0;
        }

        $columns = array_keys($filtered);
        $placeholders = implode(', ', array_fill(0, count($columns), '?'));
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $this->table,
            implode(', ', $columns),
            $placeholders
        );

        $stmt = $this->prepare($sql);
        $this->bindValues($stmt, array_values($filtered));
        $stmt->execute();
        $insertId = $stmt->insert_id;
        $stmt->close();

        return $insertId;
    }

    /**
     * @param array<string, mixed> $data
     */
    public function updateById(int $id, array $data): bool
    {
        $filtered = $this->filterFillable($data);
        if ($filtered === []) {
            return false;
        }

        $sets = [];
        foreach (array_keys($filtered) as $column) {
            $sets[] = $column . ' = ?';
        }

        $sql = sprintf('UPDATE %s SET %s WHERE id = ?', $this->table, implode(', ', $sets));
        $stmt = $this->prepare($sql);
        $values = array_values($filtered);
        $values[] = $id;
        $this->bindValues($stmt, $values);
        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }

    public function deleteById(int $id): bool
    {
        $sql = sprintf('DELETE FROM %s WHERE id = ?', $this->table);
        $stmt = $this->prepare($sql);
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }

    public function count(): int
    {
        $sql = sprintf('SELECT COUNT(*) as total FROM %s', $this->table);
        $result = $this->db()->query($sql);

        if (!$result) {
            return 0;
        }

        $row = $result->fetch_assoc();
        return (int) ($row['total'] ?? 0);
    }

    protected function db(): mysqli
    {
        return Database::getConnection();
    }

    /**
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    protected function filterFillable(array $data): array
    {
        if ($this->fillable === []) {
            return $data;
        }

        return array_intersect_key($data, array_flip($this->fillable));
    }

    /**
     * @param array<int, mixed> $values
     */
    protected function bindValues(mysqli_stmt $stmt, array $values): void
    {
        if ($values === []) {
            return;
        }

        $types = '';
        $refs = [];
        foreach ($values as $index => $value) {
            $types .= match (gettype($value)) {
                'integer' => 'i',
                'double' => 'd',
                default => 's',
            };
            $refs[$index] = &$values[$index];
        }

        $stmt->bind_param($types, ...$refs);
    }

    protected function prepare(string $sql): mysqli_stmt
    {
        $stmt = $this->db()->prepare($sql);
        if (!$stmt instanceof mysqli_stmt) {
            throw new RuntimeException('Cannot prepare SQL statement: ' . $sql);
        }

        return $stmt;
    }
}
