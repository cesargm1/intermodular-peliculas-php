<?php

namespace App;


class ListarUsuarios
{

    public static function getAll(): array
    {
        $conn = Connection::conn();
        $query = "SELECT * FROM  usuarios ORDER BY nombre";
        $result = $conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function get(int $usuarioId): null|false|object
    {
        $conn = Connection::conn();
        $query = "SELECT * FROM  usuarios WHERE usuario_id = $usuarioId";
        $result = $conn->query($query);
        return $result->fetch_object();
    }
}
