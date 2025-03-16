<?php

namespace App;


class EliminarPelicula
{
    public static function deletefilm(int $peliculaId): bool
    {
        $conn = Connection::conn();
        $query = "DELETE FROM peliculas WHERE pelicula_id = $peliculaId";
        return $conn->query($query);
    }
}
