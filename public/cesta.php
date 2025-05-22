<?php

use App\ObtenerPeliculas;
use App\Carrito;

include_once '../vendor/autoload.php';

use App\User\Auth;

$user = Auth::user();
$nombreUsuario = $user['nombre'] ?? 'Invitado';

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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="svg/logo.svg" />
    <title>cesta</title>
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/carrito.css">
    <link rel="stylesheet" href="/css/footer.css">
</head>

<body>
    <?php include_once '../resources/header.php' ?>
    <main class="container">
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
                        <a class="quit" href="/cesta.php?accion=quitar&peliculaId=<?php echo $peliculaId ?>">-</a>
                        <p class="cantidad cart-text"> <?php echo "cantidad: " . $cantidad ?></p>
                        <a class="add" href="/cesta.php?peliculaId=<?php echo $peliculaId ?>">+</a>
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

                    <button class="buy">Detalles de la compra</button>
                    <div class="modal">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="close">&times;</span>
                                <h2>Resumen de la compra</h2>
                            </div>
                            <div class="modal-body">

                                <?php
                                foreach ($peliculas as $pelicula) {
                                    $nombre = $pelicula['nombre'];
                                    $precio = $pelicula['precio'];
                                    $cantidad = $pelicula['cantidad'];
                                    $imagen = $pelicula['imagen'];


                                ?>
                                    <section class="container__modal">

                                        <p>Nombre del producto: <?php echo $nombre ?> </p>
                                        <hr>

                                        <p>Imagen del producto</p>

                                        <img class="modal__img" title="<?php echo $nombre ?>" src="data:image/jpeg;base64,<?php echo $imagen ?>" alt="<?php echo $nombre ?>">

                                        <section class="buy__detaills">

                                            <p>cantidad :<?php echo $cantidad ?> </p>
                                            <p>precio unitario del producto: <?php echo $precio ?>€ </p>
                                            <p>Total producto: <?php echo $precio * $cantidad ?>€ </p>

                                        <?php  } ?>
                                        </section>
                                        <hr>
                                        <p>Total a pagar: <?php echo $total ?>€ </p>
                                    </section>
                                    <br>
                                    <br>
                                    <a class="buy" href="comprar.php">Confirmar compra</a>
                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </section>

        </div>
    </main>
    <?php include_once '../resources/footer.php' ?>
    <script src="js/modal.js"></script>
</body>

</html>