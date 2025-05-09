<?php

namespace App;

use Dotenv\Dotenv;
use Exception;
use mysqli;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

class Connection
{
    const SERVER_NAME = 'localhost';
    const DATABASE = 'peliculasIntermodular';
    const PORT = 3306;

    public static function conn(): mysqli
    {
        $username = $_ENV['DB_USERNAME'] ?? 'root';
        $pasword = $_ENV['DB_PASSWORD'] ?? '';
        // descomentar soket si no lo utilizo
        $soket = $_ENV['DB_SOCKET'] ?? '';

        // descomentar soket si no lo utilizo
        $conn = new mysqli(static::SERVER_NAME, $username, $pasword, static::DATABASE, static::PORT, $soket);

        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}
