<?php

use App\ObtenerPeliculas;


$buscador = $_GET['buscador'] ?? '';

if (!empty($buscador)) {
    include_once '../vendor/autoload.php';

    $peliculas = ObtenerPeliculas::serchPeliculas($buscador);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>buscador</title>
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/peliculas.css">
    <link rel="stylesheet" href="/css/footer.css">
</head>

<body>
    <?php include_once '../resources/header.php' ?>

    <main class="main">
        <?php
        if (!empty($buscador)) {
        ?>
            <section class="peliculas">
                <?php foreach ($peliculas as $pelicula) {
                    $peliculaId = $pelicula['pelicula_id'];
                    $nombre = $pelicula['nombre'];
                    $precio = $pelicula['precio'];
                    $descripcion = $pelicula['descripcion'];
                    $genero = $pelicula['genero'];
                    $imagen = $pelicula['imagen'];
                ?>

                    <article class="peliculas__article">
                        <img class="peliculas__article__img" src="data:image/jpeg;base64,<?php echo $imagen ?>" alt="<?php echo $nombre ?>">
                        <h2><?php echo $nombre ?></h2>
                        <span><?php echo $precio ?> €</span>
                        <p class="parrafo"><?php echo $descripcion ?></p>
                        <p><?php echo $genero ?></p>

                        <a class="peliculas__article__button" href="cesta.php?peliculaId=<?php echo $peliculaId ?> ">Comprar</a>
                    </article>

                <?php } ?>


            </section>
        <?php
        } else {
            echo "<p class='error'>Por favor busca una pelicula !gilipollas¡</p>";
        }
        ?>
    </main>

    <?php include_once '../resources/footer.php' ?>


</body>

</html>