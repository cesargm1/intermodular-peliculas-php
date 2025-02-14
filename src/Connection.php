<?php

namespace App;

use Exception;
use mysqli;

class Connection
{
    const SERVER_NAME = 'localhost';
    const USER_NAME = 'root';
    const USER_PASSWORD = 'root';
    const DATABASE = 'peliculasIntermodular';
    const PORT = 3306;

    public static function conn(): mysqli
    {
        $conn = new mysqli(static::SERVER_NAME, static::USER_NAME, static::USER_PASSWORD, static::DATABASE, static::PORT);

        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}
