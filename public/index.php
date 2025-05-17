<?php

use App\ObtenerPeliculas;

include_once '../vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="svg/logo.svg" />
    <title>pagina de inicio</title>
    <script src="/js/swiper-bundle.min.js"></script>
    <link
        rel="stylesheet"
        href="/css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/index.css">
</head>

<body class="body">
    <?php include_once '../resources/header.php' ?>

    <main class="main">
        <section class="banner">
            <h1>Peflix: Las mejores películas al alcance de un click</h1>
            <p class="description">
                Bienvenido a <strong>Peflix</strong> , el destino definitivo para los amantes del cine. Descubre una selección exclusiva de películas en todos los géneros, desde los clásicos inolvidables hasta los últimos estrenos. Ya sea
                que busques tu película favorita en formato físico o digital, aquí la encontrarás con las mejores ofertas y la garantía de una compra segura. Sumérgete en la
                magia del cine y lleva la mejor experiencia a tu hogar. ¡Explora nuestro catálogo y haz que cada noche sea de película!
            </p>
            <a href="catalogo.php">Consulta Nuestro catalogo de peliculas, actualmente tenemos <?php echo ObtenerPeliculas::count() ?> peliculas </a>

        </section>

        <div class="icons">
            <div class="bag icon">
                <img src="svg/main_page/bag.svg" alt="bolsa">
                <p>Compra rapida</p>
            </div>

            <div class="clock icon">
                <img src="svg/main_page/clock.svg" alt="clock">
                <p>Tiempo expres</p>
            </div>

            <div class="trunk icon">
                <img src="svg/main_page/trunk.svg" alt="envio">
                <p>seguimiento del pedido 24h</p>
            </div>

        </div>

        <h2>peliculas añadidas recientemente </h2>
        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php

                $peliculas =  ObtenerPeliculas::lastFilms(4);
                foreach ($peliculas as $pelicula) {
                    $imagen = $pelicula['imagen'];
                    $nombre = $pelicula['nombre'];
                ?>
                    <div class="swiper-slide" data-swiper-autoplay="2000">
                        <img class="slide__img" src="data:image/jpeg;base64,<?php echo $imagen ?>" alt="<?php echo $nombre ?>">
                    </div>
                <?php }  ?>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <!-- If we need scrollbar -->
            <div class="swiper-scrollbar"></div>
        </div>

        <button class="btn btn-primary">Prueba Bootstrap</button>

        <h2>Peliculas mas economicas</h2>

        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php

                $peliculas =  ObtenerPeliculas::cheapFilms();
                foreach ($peliculas as $pelicula) {
                    $imagen = $pelicula['imagen'];
                    $nombre = $pelicula['nombre'];
                ?>
                    <div class="swiper-slide" data-swiper-autoplay="2000">
                        <img class="slide__img" src="data:image/jpeg;base64,<?php echo $imagen ?>" alt="<?php echo $nombre ?>">
                    </div>
                <?php }  ?>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <!-- If we need scrollbar -->
            <div class="swiper-scrollbar"></div>
        </div>
    </main>

    <?php include_once '../resources/footer.php' ?>
    <script src="js/swiper.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>