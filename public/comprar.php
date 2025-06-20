<?php

use App\Carrito;
use App\CrearUsuario;
use App\Session;
use App\User\Auth;
use App\Validator;

include_once '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: /index.php');
    exit();
}

$user = Auth::user();
$usuarioId = $user['usuario_id'];

$carrito = new Carrito();
$carrito->asociarUsuario($usuarioId);
$session = new Session();
$session->regenerateId();

?>


<html lang="es">

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
        <a href="/index.php">Volver a la pagina de inicio</a>
    </div>
</body>

</html>