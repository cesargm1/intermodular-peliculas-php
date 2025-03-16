<?php

namespace App;


class ListarUsuarios
{
    public static function listUsers(): bool
    {
        $conn = Connection::conn();
        $query = "SELECT * FROM usuarios";
        return $conn->query($query);
    }
}
