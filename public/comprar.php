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

echo "Tu compra fue realizada correctamente";
