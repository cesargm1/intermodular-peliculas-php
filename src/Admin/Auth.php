<?php

namespace App\Admin;

use App\Connection;

class Auth
{
    public function login(string $email, string $password): bool
    {
        $conn = Connection::conn();
        $query = "SELECT * FROM usuarios WHERE  email = ? AND rol = 'admin'";

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
            'name' => 'panel_session',
            'cookie_lifetime' => 1800
        ]);

        $_SESSION['id'] = $user->usuario_id;
        $_SESSION['name'] = $user->nombre;
        $_SESSION['cookie_lifetime'] = $user->cookie;

        return true;
    }

    public static function check(): bool
    {
        session_start([
            'name' => 'panel_session',
            'cookie_lifetime' => 1800

        ]);

        $id = $_SESSION['id'] ?? false;

        if ($id) {
            return true;
        }

        return false;
    }

    public static function mustBeLogged()
    {
        $auth = new Auth();

        if (!$auth->check()) {
            header('Location: /panel/login.php');
            die();
        }
    }

    public static function logOut()
    {
        // Inicializar la sesión.
        // Si está usando session_name("algo"), ¡no lo olvide ahora!
        session_start([
            'name' => 'panel_session',
            'cookie_lifetime' => 1800
        ]);
        // Finalmente, destruir la sesión.
        session_destroy();
    }
}
