<?php

use App\Carrito;
use App\CrearUsuario;
use App\Session;
use App\Validator;
use App\ValidatorException;

include_once '../vendor/autoload.php';

$nombre = $_POST['nombre'] ?? '';
$correo = $_POST['correo'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$telefono = $_POST['telefono'] ?? '';


try {

    // capcha
    session_start();

    // Obtener el valor del CAPTCHA desde la sesión
    $codeVerify = isset($_SESSION['code_verify']) ? $_SESSION['code_verify'] : '';

    // Obtener el valor ingresado por el usuario
    $capcha = isset($_POST['capcha']) ? $_POST['capcha'] : '';

    // Verificar si el campo CAPTCHA está vacío
    if ($capcha == '') {
        echo 'Por favor, ingresa el código CAPTCHA.';
        exit;
    }

    // Hashear el valor ingresado para la comparación
    $capchaHashed = sha1($capcha);

    // Comparar el valor ingresado con el de la sesión
    if ($codeVerify != $capchaHashed) {
        $_SESSION['code_verify'] = ''; // Borrar el valor de la sesión si el código es incorrecto
        echo 'El código de verificación es incorrecto.';
        exit;
    }



    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die('Forbidden, require data');
    }

    $validatorName = new Validator($nombre, 'Nombre del usuario');
    $validatorName->require();

    $validatorCorreo = new Validator($correo, "Nombre de correo electronico");
    $validatorCorreo->require()->email();

    $validatorDireccion = new Validator($direccion, "Direccion del usuario");
    $validatorDireccion->require();

    $validatorTelefono = new Validator($telefono, "Telefono del usuario");
    $validatorTelefono->require();
} catch (ValidatorException $exception) {
    die($exception->getMessage());
}

$usuarioId = CrearUsuario::crear($nombre, $correo, $direccion, $telefono);
$carrito = new Carrito();
$carrito->asociarUsuario($usuarioId);
$session = new Session();
$session->regenerateId();
?>


<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Compra realizada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        .message {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="message">
        <h1>¡Gracias por tu compra!</h1>
        <p>
            Tu compra de nuestra aplicación de películas se ha realizado con éxito.
        </p>
        <p>
            Esperamos que disfrutes de una experiencia cinematográfica increíble.
        </p>
        <p>Si tienes alguna pregunta, no dudes en contactarnos.</p>
        <p><strong>¡Que disfrutes de tus películas!</strong></p>
    </div>
</body>

</html>