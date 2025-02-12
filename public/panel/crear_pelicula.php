<?php

use App\CrearPelicula;
use App\Validator;
use App\ValidatorException;

include_once '../../vendor/autoload.php';

$nombre = $_POST['nombre'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$precio = $_POST['precio'] ?? '';
$imagen = $_FILES['imagen'];


try {
    $validatorName = new Validator($nombre, 'Nombre del producto');
    $validatorName->require();

    $validatorDescription = new Validator($descripcion, "descripcion del producto");
    $validatorDescription->require();

    $validatorPrecio = new Validator($precio, "Precio del producto");
    $validatorPrecio->require()->min(0);

    $validatorImagen = new Validator($imagen['tmp_name'], "imagen del producto");
    $validatorImagen->require();
} catch (ValidatorException $exception) {
    die($exception->getMessage());
}

$imagenContent = file_get_contents($imagen['tmp_name']);

$creada = CrearPelicula::crear($nombre, $descripcion, $precio, $imagenContent);

if ($creada) {
    echo 'La pelicula se creo correctamente';
} else {
    echo 'La pelicula no pudo crearse';
}
