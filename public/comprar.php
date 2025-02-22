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
