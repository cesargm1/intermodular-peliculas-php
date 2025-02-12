<?php

namespace App;


class CrearPelicula
{
    public static function crear($nombre, $descripcion, $precio, $imagen): bool
    {
        $conn = Connection::conn();
        $query = "INSERT INTO peliculas (nombre, descripcion, precio, imagen) VALUES (?, ?, ?,?)";

        $stmt = $conn->prepare($query);
        $imageHex = base64_encode($imagen);
        $stmt->bind_param('ssds', $nombre, $descripcion, $precio, $imageHex);

        return $stmt->execute();
    }
}
