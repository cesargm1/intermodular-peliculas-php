<?php

use App\ObtenerPeliculas;

include_once '../vendor/autoload.php';

$peliculaId = (int) ($_GET['id'] ?? '');
$peliculaId =  ($_GET['peliculaId'] ?? '');
$pelicula = ObtenerPeliculas::get($peliculaId);
$nombre = $pelicula->nombre ?? '';
$peliculaId =  $pelicula->peliculaId ?? '';
$precio = $pelicula->precio ?? '';
$descripcion = $pelicula->descripcion ?? '';
$imagen = $pelicula->imagen ?? '';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios sobre <?php echo htmlspecialchars($nombre) ?></title>
    <link rel="icon" type="image/x-icon" href="svg/logo.svg" />
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/peliculas.css">
    <link rel="stylesheet" href="/css/footer.css">
</head>

<body>
    <?php include_once '../resources/header.php'; ?>
    <main class="container">
        <section class="peliculas">
            <article class="peliculas__article">
                <img class="peliculas__article__img" src="data:image/jpeg;base64,<?php echo $imagen ?>" alt="<?php echo $nombre ?>">
                <h1><?php echo ($nombre) ?></h1>
                <span><?php echo ($precio) ?> €</span>
                <p class="parrafo"><?php echo ($descripcion)  ?></p>
                <!-- <a class="peliculas__article__button" href="cesta.php?peliculaId=<?php echo $peliculaId ?> ">Comprar</a> -->
            </article>
            <a href="./panel/login.php">¿Qieres comentar registrate?</a>
    </main>
    <?php include_once '../resources/footer.php' ?>

</body>

</html>