<?php

use App\ObtenerPeliculas;

include_once '../vendor/autoload.php';

$peliculas = ObtenerPeliculas::getAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="svg/logo.svg" />
    <title>Document</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/index.css">
    <script src="src/carousel.js"></script>

</head>

<body>
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
                <p>Compra rapida</p>
            </div>

            <div class="trunk icon">
                <img src="svg/main_page/trunk.svg" alt="bolsa">
                <p>Compra rapida</p>
            </div>

        </div>

        <h2>Las mejores</h2>
        <section class="container__carousel">
            <button class="prev">&#10094;</button>
            <div class="carousel">
                <div class="slide">
                    <img class="slide__img" src="img/carousel/harry_potter.jpg" alt="harry potter">
                </div>

                <div class="slide">
                    <img class="slide__img" src="img/carousel/star_wars.jpg" alt="star wars">
                </div>

                <div class="slide">
                    <img class="slide__img" src="img/carousel/joker.jpg" alt="joker">
                </div>
            </div>
            <button class="next">&#10095;</button>
        </section>
    </main>

    <?php include_once '../resources/footer.php' ?>
</body>

</html>