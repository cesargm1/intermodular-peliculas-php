<?php

namespace App;

use App\User\Auth;
// use Exception;

class Comentarios
{
    public static function insertComment($comentario, $peliculaId): bool
    {
        $conn = Connection::conn();
        if ($comentario) {
            $user = Auth::user();
            $query = "INSERT INTO comentarios (nombre_usuario , fecha, comentario, pelicula_id, usuario_id) VALUES (?, NOW(), ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssii', $user['nombre'], $comentario, $peliculaId, $user['usuario_id']);


            return $stmt->execute();
        } else {
            echo "comentario no insertado";
        };

        return true;
    }

    public static function getAll() {}
}
