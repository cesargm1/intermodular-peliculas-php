<?php

namespace App;


class ListarComentarios
{
    public static function get(int $peliculaid): array
    {
        $conn = Connection::conn();
        $query = "SELECT * FROM  comentarios WHERE pelicula_id = $peliculaid";
        $result = $conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
