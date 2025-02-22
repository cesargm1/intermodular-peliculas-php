<?php

namespace App;

class CrearUsuario
{
    public static function crear($nombre, $correo, $direccion, $telefono): int
    {
        $conn = Connection::conn();
        $query = "INSERT INTO usuarios (nombre, email, direccion_envio, telefono) VALUES (?, ?,?,?)";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $nombre, $correo, $direccion, $telefono);

        $stmt->execute();

        return $stmt->insert_id;
    }
}
