<?php

use App\Admin\Auth;
use App\EliminarUsuario;
use App\ListarUsuarios;

include_once '../../vendor/autoload.php';
Auth::mustBeLogged();

$action = $_POST['action'] ?? null;

if ($action === 'eliminar') {
    $usuarioId = (int)$_POST['usuario_id'];
    EliminarUsuario::deleteUser($usuarioId);
}

$usuarios = ListarUsuarios::getAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado usuarios</title>
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/panel/tables.css">
</head>
<?php include_once '../../resources/panel/header.php' ?>

<body>
    <h1>Listado de usuarios</h1>
    <table>
        <tr>
            <th>#</th>
            <th>nombre</th>
            <th>email</th>
            <th>dirrecion envio</th>
            <th>telefono</th>
            <th>rol</th>
            <th></th>
        </tr>

        <?php foreach ($usuarios as $usuario) { ?>
            <tr>
                <td><?php echo $usuario['usuario_id'] ?></td>
                <td><?php echo $usuario['nombre'] ?></td>
                <td><?php echo $usuario['email'] ?></td>
                <td><?php echo $usuario['direccion_envio'] ?></td>
                <td><?php echo $usuario['telefono'] ?></td>
                <td><?php echo $usuario['rol'] ?></td>


                <td>
                    <button>Editar</button>
                    <form method="post">
                        <input type="hidden" name="usuario_id" value="<?php echo $usuario['usuario_id'] ?>">
                        <input type="submit" name="action" value="eliminar">
                    </form>

                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>