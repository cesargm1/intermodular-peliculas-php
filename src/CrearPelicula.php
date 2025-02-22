<?php

namespace App;


class CrearPelicula
{
    public static function crear($nombre, $descripcion, $precio, $genero, $imagen): bool
    {
        $conn = Connection::conn();
        $query = "INSERT INTO peliculas (nombre, descripcion, precio, genero, imagen) VALUES (?,?, ?,?,?)";

        $stmt = $conn->prepare($query);
        $imageHex = base64_encode($imagen);
        $stmt->bind_param('ssdss', $nombre, $descripcion, $precio, $genero, $imageHex);

        return $stmt->execute();
    }
}
