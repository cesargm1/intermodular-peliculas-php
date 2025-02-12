<?php

namespace App;


class ObtenerPeliculas
{
    public static function get(): array
    {
        $conn = Connection::conn();
        $query = "SELECT * FROM  peliculas ORDER BY nombre";
        $result = $conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
