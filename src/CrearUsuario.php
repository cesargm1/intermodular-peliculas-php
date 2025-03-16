<?php

namespace App;

class CrearUsuario
{
    public static function crear($nombre, $correo, $direccion, $telefono, $password, $rol): int
    {
        $conn = Connection::conn();
        $query = "INSERT INTO usuarios (nombre, email, direccion_envio, telefono, `password`,rol) VALUES (?,?,?,?,?,?)";

        $stmt = $conn->prepare($query);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bind_param('ssssss', $nombre, $correo, $direccion, $telefono, $hashed_password, $rol);

        $stmt->execute();

        return $stmt->insert_id;
    }
}
