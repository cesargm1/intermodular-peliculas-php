<?php

namespace App;


class ListarComentarios
{

    public static function getAll(): array
    {
        $conn = Connection::conn();
        $query = "SELECT * FROM  comentarios ORDER BY fecha LIMIT 5";
        $result = $conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
