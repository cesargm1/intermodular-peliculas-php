<?php

namespace App;

use Exception;
use mysqli;

class Connection
{
    const SERVER_NAME = 'localhost';
    const USER_NAME = 'root';
    const DATABASE = 'peliculasIntermodular';

    public static function conn(): mysqli
    {
        $conn = new mysqli(static::SERVER_NAME, static::USER_NAME, null, static::DATABASE);

        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}
