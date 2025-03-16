<?php

namespace App;


class EliminarUsuario
{
    public static function deleteUser(int $usarioId): bool
    {
        $conn = Connection::conn();
        $query = "DELETE FROM usuarios WHERE usuario_id = $usarioId";
        return $conn->query($query);
    }
}
