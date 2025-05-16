<?php
include_once '../vendor/autoload.php';

use App\Admin\Auth;

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$messageError = '';

if ($email) {
    $auth = new Auth();
    $logged =  $auth->login($email, $password);
    if ($logged) {
        header('Location: /');
        die();
    }

    $messageError = 'Credenciales incorrectas';
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="svg/logo.svg" />
    <title>Formulario de registro</title>
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>
    <main class="main">
        <section class="main__section">
            <form class="form" method="post">
                <h1 class="h1">Inicio de sesion</h1>
                <div class="input__container">
                    <label>
                        <div class="icon__container">
                            <img class="img__icon" src="/svg/login/email.svg" alt="icono">
                        </div>


                        <input autofocus class="input" name="email" type="text" required placeholder="Introduce tu email">
                    </label>
                </div>

                <div class="input__container">
                    <label>
                        <div class="icon__container">
                            <img class="img__icon" src="/svg/login/password.svg" alt="icono">
                        </div>


                        <input class="input" name="password" type="password" required placeholder="introduce contraseña">
                    </label>

                </div>
                <button class="button" type="submit">Iniciar sesion</button>
                <a href="registro.php">no tienes cuenta crea una</a>
                <?php
                if ($messageError) {
                ?>
                    <span class="error"><?php echo $messageError ?></span>
                <?php
                }
                ?>
            </form>
        </section>
    </main>
</body>

</html>