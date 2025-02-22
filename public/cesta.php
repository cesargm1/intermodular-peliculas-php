<?php

use App\ObtenerPeliculas;

use App\Carrito;

include_once '../vendor/autoload.php';

$peliculaId = $_GET['peliculaId'] ?? null;
$accion = $_GET['accion'] ?? 'agregar';


$carrito = new Carrito();
$obtenerPeliculas = new ObtenerPeliculas;

if ($peliculaId != null) {
    if ($accion === 'agregar') {
        $carrito->agregar($peliculaId);
    } else {
        $carrito->quitar($peliculaId);
    }
}
$peliculas = $carrito->peliculas();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cesta</title>
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/carrito.css">
</head>

<body>
    <?php include_once '../resources/header.php' ?>
    <section class="container">
        <p>cesta</h2>
        <div class="section__div">
            <?php
            $total = 0;
            foreach ($peliculas as $pelicula) {
                $peliculaId = $pelicula['pelicula_id'];
                $nombre = $pelicula['nombre'];
                $precio = $pelicula['precio'];
                $cantidad = $pelicula['cantidad'];
                $descripcion = $pelicula['descripcion'];
                $imagen = $pelicula['imagen'];
                $total = $total + $cantidad * $precio;
            ?>

                <section class="peliculas">
                    <img class="img cart-text" title="<?php echo $nombre ?>" src="data:image/jpeg;base64,<?php echo $imagen ?>" alt="<?php echo $nombre ?>">
                    <p class="nombre cart-text"><?php echo $nombre ?></p>
                    <div class="cantidad__buttons">
                        <a class="quit" href="/cesta.php?accion=quitar&peliculaId=<?php echo $peliculaId ?>">quitar</a>
                        <p class="cantidad cart-text"> <?php echo "cantidad: " . $cantidad ?></p>
                        <a class="add" href="/cesta.php?peliculaId=<?php echo $peliculaId ?>">añadir</a>
                    </div>
                    <p class="precio cart-text"> <?php echo  $precio * $cantidad ?>€</p>
                </section>
            <?php } ?>

            <hr>
            <section class="section__buy">
                <?php
                if (count($peliculas) === 0) {
                    echo "<p>Cesta vacia</p>";
                } else {
                ?>
                    <a class="buy" href="login.php">comprar</a>
                <?php } ?>
                <span>Total: <?php echo $total ?>€ </span>

            </section>

        </div>
    </section>
</body>

</html>