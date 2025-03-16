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
            'name' => 'panel_session'
        ]);

        $_SESSION['id'] = $user->usuario_id;
        $_SESSION['name'] = $user->nombre;

        return true;
    }

    public function check(): bool
    {
        session_start([
            'name' => 'panel_session'
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
}
