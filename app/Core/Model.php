<?php

namespace App\Core;

use mysqli;

abstract class Model
{
    protected string $table = '';

    public function getTable(): string
    {
        return $this->table;
    }

    protected function db(): mysqli
    {
        return Database::getConnection();
    }
}
