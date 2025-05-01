<?php

use App\ObtenerPeliculas;

include_once '../vendor/autoload.php';

$peliculaId = $_GET['id'] ?? '';

$pelicula = ObtenerPeliculas::get($peliculaId);
$nombre = $pelicula->nombre;
$precio = $pelicula->precio;
$descripcion = $pelicula->descripcion;
$imagen = $pelicula->imagen;

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mas informacion sobre <?php echo $nombre ?></title>
    <link rel="icon" type="image/x-icon" href="svg/logo.svg" />
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/footer.css">
</head>

<body>
    <?php include_once '../resources/header.php'; ?>
    <main>
        <h1>
            <?php echo $pelicula->nombre ?>
        </h1>

        <p>
            <?php echo $pelicula->descripcion  ?>
        </p>

        <a href="./panel/login.php">Qieres comentar registrate</a>
        <?php include_once '../resources/footer.php' ?>
    </main>

</body>

</html>