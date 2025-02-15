<?php

use App\ObtenerPeliculas;



if (!empty($_GET['buscador'])) {
    include_once '../vendor/autoload.php';

    $peliculas = ObtenerPeliculas::serchPeliculas($_GET['buscador']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>buscador</title>
    <link rel="stylesheet" href="/css/peliculas.css">
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <input name="buscador" type="search" value="<?php echo $_GET['buscador']   ?>">
        <button>buscar</button>
    </form>
    <h1>Peliculas</h1>

    <?php
    if (!empty($_GET['buscador'])) {
    ?>
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
    <?php
    }
    ?>


</body>

</html>