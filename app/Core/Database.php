<?php

namespace App\Core;

use mysqli;
use RuntimeException;

class Database
{
    private static ?mysqli $connection = null;

    public static function getConnection(): mysqli
    {
        if (self::$connection instanceof mysqli) {
            return self::$connection;
        }

        $config = require __DIR__ . '/../../config/database.php';

        self::$connection = new mysqli(
            $config['host'],
            $config['username'],
            $config['password'],
            $config['database'],
            $config['port']
        );

        if (self::$connection->connect_error) {
            throw new RuntimeException('Database connection failed: ' . self::$connection->connect_error);
        }

        self::$connection->set_charset('utf8mb4');

        return self::$connection;
    }
}
