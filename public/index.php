<?php

use App\ObtenerPeliculas;

include_once '../vendor/autoload.php';

$peliculas = ObtenerPeliculas::get();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/peliculas.css">
</head>

<body>
    <header class="header"></header>
    <main class="main">
        <section class="peliculas">


            <?php foreach ($peliculas as $pelicula) {
                $peliculaId = $pelicula['pelicula_id'];
                $nombre = $pelicula['nombre'];
                $precio = $pelicula['precio'];
                $descripcion = $pelicula['descripcion'];
                $imagen = $pelicula['imagen'];
            ?>

                <article class="peliculas__article">
                    <img class="peliculas__article__img" src="data:image/jpeg;base64,<?php echo $imagen ?>" alt="<?php echo $nombre ?>">
                    <h2><?php echo $nombre ?></h2>
                    <span><?php echo $precio ?> €</span>
                    <p><?php echo $descripcion ?></p>

                    <a class="peliculas__article__button" href="cesta.php?peliculaId=<?php echo $peliculaId ?> ">Comprar</a>
                </article>

            <?php } ?>


        </section>
    </main>
    <footer class="footer"></footer>
</body>

</html>