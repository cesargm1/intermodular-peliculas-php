<?php

namespace App;


class ActualizarUsuario
{
    public static function actualizar($usuarioId, $nombre, $email, $direccion_envio, $telefono, $password): bool
    {
        $conn = Connection::conn();
        if ($password) {
            $query = "UPDATE usuarios SET nombre = ?, email = ?, direccion_envio = ?, telefono = ?, `password` = ? WHERE usuario_id = ? ";


            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssssi', $nombre, $email, $direccion_envio, $telefono, $password,  $usuarioId);
        } else {
            $query = "UPDATE usuarios SET nombre = ?, email = ?, direccion_envio = ?, telefono = ? WHERE usuario_id = ? ";


            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssssi',  $nombre, $email, $direccion_envio, $telefono, $usuarioId);
        }

        return $stmt->execute();
    }
}
