<?php

namespace App;


class ActualizarPelicula
{
    public static function actualizar($peliculaId, $nombre, $descripcion, $precio, $genero): bool
    {
        $conn = Connection::conn();
        $query = "UPDATE peliculas SET nombre = ?, descripcion = ?, precio = ?, genero = ? WHERE pelicula_id = ? ";


        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssdsi', $nombre, $descripcion, $precio, $genero, $peliculaId);

        return $stmt->execute();
    }
}
