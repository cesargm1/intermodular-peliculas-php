<?php

namespace App;

use App\User\Auth;
// use Exception;

class Comentarios
{
    public static function insertComment($comentario): bool
    {
        $conn = Connection::conn();
        if ($comentario) {
            $user = Auth::user();
            $query = "INSERT INTO comentarios (nombre_usuario , fecha, comentario) VALUES (?, NOW(), ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ss', $user['nombre'], $comentario);

            return $stmt->execute();
        } else {
            echo "comentario no insertado";
        }

        return true;
    }
}
