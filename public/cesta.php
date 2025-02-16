<?php

use App\ObtenerPeliculas;

use App\Carrito;

include_once '../vendor/autoload.php';

$peliculaId = $_GET['peliculaId'] ?? null;


$carrito = new Carrito();
$obtenerPeliculas = new ObtenerPeliculas;

if ($peliculaId != null) {
    $carrito->agregar($peliculaId);
}
$peliculas = $carrito->peliculas();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cesta</title>
    <link rel="stylesheet" href="/css/carrito.css">
</head>

<body>
    <section class="container">
        <p>cesta</h2>
        <div class="section__div">
            <?php
            foreach ($peliculas as $pelicula) {
                $peliculaId = $pelicula['pelicula_id'];
                $nombre = $pelicula['nombre'];
                $precio = $pelicula['precio'];
                $cantidad = $pelicula['cantidad'];
                $descripcion = $pelicula['descripcion'];
                $imagen = $pelicula['imagen'];
            ?>

                <section class="peliculas">
                    <img class="img cart-text" title="<?php echo $nombre ?>" src="data:image/jpeg;base64,<?php echo $imagen ?>" alt="<?php echo $nombre ?>">
                    <p class="nombre cart-text"><?php echo $nombre ?></p>
                    <p class="cantidad cart-text"> <?php echo "cantidad: " . $cantidad ?></p>
                    <p class="precio cart-text"> <?php echo $precio ?>€</p>

                </section>
            <?php } ?>

            <hr>
            <section class="section_buy">
                <?php
                if (count($peliculas) === 0) {
                    echo "<p>Cesta vacia</p>";
                } else {
                ?>
                    <button class="buy">comprar</button>
                <?php } ?>
            </section>

        </div>
    </section>
</body>

</html>