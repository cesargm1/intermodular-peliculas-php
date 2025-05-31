<?php

namespace App\User;

use App\Connection;

class Auth
{
    public function login(string $email, string $password): bool
    {
        $conn = Connection::conn();
        $query = "SELECT * FROM usuarios WHERE  email = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email);

        $stmt->execute();
        $user = $stmt->get_result()->fetch_object();

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user->password)) {
            return false;
        }

        session_start([
            'name' => 'user_session',
            'cookie_lifetime' => 1800
        ]);

        $_SESSION['id'] = $user->usuario_id;
        $_SESSION['name'] = $user->nombre;
        $_SESSION['cookie_lifetime'] = $user->cookie;

        return true;
    }

    public static function check(): bool
    {
        if (!isset($_SESSION)) {
            session_start([
                'name' => 'user_session',
                'cookie_lifetime' => 1800
            ]);
        }

        $id = $_SESSION['id'] ?? false;

        if ($id) {
            return true;
        }

        return false;
    }

    public static function user(): null|array
    {
        if (!Auth::check()) {
            return null;
        }
        $conn = Connection::conn();
        $query = "SELECT usuario_id, nombre, email, direccion_envio, telefono FROM usuarios where usuario_id = ? ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $_SESSION['id']);

        $stmt->execute();
        $stmt->bind_result($usuario_id, $nombre, $email, $direccion_envio, $telefono);
        $stmt->fetch();
        return [
            'usuario_id' => $usuario_id,
            'nombre' => $nombre,
            'email' => $email,
            'direccion_envio' => $direccion_envio,
            'telefono' => $telefono
        ];
    }


    public static function logOut()
    {
        // Inicializar la sesión.
        // Si está usando session_name("algo"), ¡no lo olvide ahora!
        session_start([
            'name' => 'user_session',
            'cookie_lifetime' => 1800
        ]);
        // Finalmente, destruir la sesión.
        session_destroy();
    }
}
