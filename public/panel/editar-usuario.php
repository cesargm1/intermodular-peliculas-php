<?php

use App\ActualizarUsuario;
use App\Admin\Auth;
use App\ListarUsuarios;
use App\Validator;
use App\ValidatorException;
use GrahamCampbell\ResultType\Success;

include_once '../../vendor/autoload.php';
Auth::mustBeLogged();
$usuarioId = $_GET['usuario_id'] ?? null;

if (!$usuarioId) {
    header("HTTP/1.0 404 Not Found");
    die('usuario no existe');
}

$messageError = '';
$messageSuccess = '';
$action = $_POST['action'] ?? null;

if ($action === 'update') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $direccion_envio = $_POST['direccion_envio'];
    $telefono = $_POST['telefono'];
    $password = $_POST['password'];


    try {
        $validatorName = new Validator($nombre, 'Nombre del usuario');
        $validatorName->require();

        $validatorEmail = new Validator($email, "Email del usuario");
        $validatorEmail->require();

        $validatorDireccionEnvio = new Validator($direccion_envio, "direccion de envio");
        $validatorDireccionEnvio->require();

        $validatorTelefono = new Validator($telefono, "numero de telefono del usuario");
        $validatorTelefono->require();

        ActualizarUsuario::actualizar($usuarioId, $nombre, $email, $direccion_envio, $telefono, $password);
        $messageSuccess = 'Usuario actualizado correctamente';
    } catch (ValidatorException $exception) {
        $messageError = $exception->getMessage();
    }
}

$usuario = ListarUsuarios::get($usuarioId);

if (!$usuario) {
    header("HTTP/1.0 404 Not Found");
    die('Usuario no existe');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>editar Usuario</title>
    <link rel="stylesheet" href="/css/login.css" />
</head>

<body class="body">
    <main class="main">
        <section class="main__section">
            <form class="form" method="post">

                <h1 class="h1">editar Uusario</h1>

                <?php
                if ($messageSuccess) {
                    echo "<div class=\"success\"> $messageSuccess </div>";
                }
                ?>

                <?php
                if ($messageError) {
                    echo "<span class='error'> $messageError </span>";
                }
                ?>

                <div class="input__container">
                    <label class="warp__label">
                        Nombre
                        <input class="input" type="text" name="nombre" value="<?php echo $usuario->nombre ?>" required />
                    </label>
                </div>

                <div class="input__container">
                    <label class="form__label">
                        email
                        <input class="input" type="email" name="email" value="<?php echo $usuario->email ?>" required />
                    </label>
                </div>

                <div class="input__container">
                    <label class="warp__label">
                        dirreccion de envio
                        <input class="input" type="text" name="direccion_envio" value="<?php echo $usuario->direccion_envio ?>" required />
                    </label>
                </div>

                <div class="input__container">
                    <label class="warp__label">
                        telefono
                        <input class="input" type="text" name="telefono" value="<?php echo $usuario->telefono ?> " required />
                    </label>
                </div>

                <div class="input__container">
                    <label class="warp__label">
                        password
                        <input class="input" type="password" name="password" value="" placeholder="escribe la contraseña para modificarla" />
                    </label>
                </div>
                <button class="button" type="submit" name="action" value="update">Modificar usuario</button>
            </form>
        </section>
    </main>
</body>

</html>