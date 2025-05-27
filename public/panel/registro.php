<?php
include_once '../../vendor/autoload.php';

use App\CrearUsuario;
use App\Validator;
use App\ValidatorException;

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $password = $_POST['password'] ?? '';
    $rol = $_POST['rol'] ?? 'usuario';
    $capcha = $_POST["capcha"] ?? '';
    $codeVerify = $_SESSION['code_verify'] ?? '';

    // 1. Validar CAPTCHA
    if ($capcha === '') {
        die("Por favor, ingresa el código CAPTCHA.");
    }

    if (sha1($capcha) !== $codeVerify) {
        $_SESSION['code_verify'] = '';
        die("El código de verificación es incorrecto.");
    }

    // 2. Validar los campos
    try {
        (new Validator($nombre, 'Nombre'))->require();
        (new Validator($correo, 'Correo'))->require()->email();
        (new Validator($direccion, 'Dirección'))->require();
        (new Validator($telefono, 'Teléfono'))->require();
        (new Validator($password, 'Contraseña'))->require();
        (new Validator($rol, 'rol'))->require();
    } catch (ValidatorException $e) {
        die($e->getMessage());
    }

    CrearUsuario::crear($nombre, $correo, $direccion, $telefono, $password, $rol);
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="svg/logo.svg" />
    <title>Formulario de registro panel</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>

<body>
    <main class="main">
        <section class="main__section">
            <form class="form" method="post">
                <h1 class="h1">Registro de usuarios por el panel</h1>
                <div class="input__container">
                    <label>
                        <div class="icon__container">
                            <img class="img__icon" src="/svg/login/user.svg" alt="icono">
                        </div>


                        <input class="input" name="nombre" type="text" required placeholder="Introduce tu nombre de usuario">
                    </label>
                </div>

                <div class="input__container">
                    <label>
                        <div class="icon__container">
                            <img class="img__icon" src="/svg/login/email.svg" alt="icono">
                        </div>


                        <input class="input" name="correo" type="email" required placeholder="introduce tu correo electronico">
                    </label>

                </div>

                <div class="input__container">

                    <label>
                        <div class="icon__container">
                            <img class="img__icon" src="/svg/login/truck.svg" alt="icono">
                        </div>


                        <input class="input" name="direccion" type="text" required placeholder="introduce la direccion de envio">
                    </label>


                </div>

                <div class="input__container">
                    <label>
                        <div class="icon__container">
                            <img class="img__icon" src="/svg/login/phone.svg" alt="icono">
                        </div>

                        <input class="input" name="telefono" type="tel" required placeholder="introduce el numero de telefono">
                    </label>
                </div>

                <div class="input__container">
                    <label>
                        <div class="icon__container">
                            <img class="img__icon" src="/svg/login/password.svg" alt="icono">
                        </div>

                        <input class="input password" name="password" id="key1" type="password" required placeholder="Vuelve a introducir tu contraseña">

                        <div class="icon__container">
                            <img class="img__icon viewPasswords" src="/svg/login/eye.svg" alt="eye">
                        </div>
                    </label>
                </div>

                <div class="input__container">
                    <label>
                        <div class="icon__container">
                            <img class="img__icon" src="/svg/login/password.svg" alt="icono">
                        </div>

                        <input class="input password" name="password" id="key2" type="password" required placeholder="Vuelve a introducir tu contraseña">

                        <div class="icon__container">
                            <img class="img__icon viewPasswords" src="/svg/login/eye.svg" alt="eye">
                        </div>
                    </label>
                </div>

                <div class="input__container">
                    <label>
                        <input class="input" type="text" name="capcha" placeholder="Escribe el capcha" />
                    </label>
                </div>
                <img class="img__capcha" src="../capcha/funcs/generate_code.php" alt="capcha" />

                <button class="button-generate-capcha" type="button">
                    + genera nuevo codigo
                </button>
                <p>Elije tu rol</p>
                <label>
                    <label>administrador
                        <input type="radio" class="rol" name="rol" value="admin">
                    </label><br>

                    <label>usuario
                        <input type="radio" class="rol" name="rol" value="usuario">
                    </label><br>
                </label>

                <button class="button" type="submit" onclick="return checkPassword(event)">Crear cuenta</button>
                <a href="login.php">Ya tienes cuenta ? Inicia sesion</a>
            </form>
        </section>
    </main>
</body>
<script src="../js/viewPassword.js"></script>
<script src="../js/checkPassword.js"></script>
<script>
    // por js selecionamos la imagen del capcha y tambien el boton de generar nuevo
    const imgCodes = document.querySelector(".img__capcha");
    const buttonsGenerate = document.querySelector(".button-generate-capcha");
    buttonsGenerate.addEventListener('click', generateCode, false)

    // Creamos un evento click al boton para que suceda algo llarama a una funcion

    /*parametros

    useCapture	Optional (default = false).
    false - The handler is executed in the bubbling phase.
    true - The handler is executed in the capturing phase.
    */

    //  al hacer click llama a la funcion generateCode le pasamos los botones como parametro

    function generateCode() {


        // aqui le decimos donde esta el script para que cambie la imagen
        let url = "../capcha/funcs/generate_code.php";

        fetch(url)
            .then(response => response.blob())
            .then(data => {
                if (data) {
                    imgCodes.src = URL.createObjectURL(data)
                }
            })
    }
</script>

</html>