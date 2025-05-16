<?php

use App\Comentarios;
use App\ListarComentarios;
use App\ObtenerPeliculas;

use App\User\Auth;
use App\Validator;


include_once '../vendor/autoload.php';
$peliculaId = (int) ($_GET['peliculaId'] ?? '');
$pelicula = ObtenerPeliculas::get($peliculaId);
$nombre = $pelicula->nombre ?? '';
$peliculaId =  $pelicula->peliculaId ?? '';
$precio = $pelicula->precio ?? '';
$descripcion = $pelicula->descripcion ?? '';
$imagen = $pelicula->imagen ?? '';
$comentarios = ListarComentarios::getAll();
$userLogged = Auth::check();


$action = $_POST['action'] ?? null;

if ($action == 'comment_add') {
    $comentario = $_POST['comentario'] ?? '';
    $validator = new Validator($comentario, "Rellena el comentario para continuar");
    $validator->require();
    $comentario = Comentarios::insertComment($comentario);
}



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios sobre <?php echo htmlspecialchars($nombre) ?></title>
    <link rel="icon" type="image/x-icon" href="svg/logo.svg" />
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/comentarios-peliculas.css">
    <link rel="stylesheet" href="/css/footer.css">
</head>

<body>
    <?php include_once '../resources/header.php'; ?>
    <main class="main">
        <section class="peliculas">
            <article class="peliculas__article">
                <img class="peliculas__article__img" src="data:image/jpeg;base64,<?php echo $imagen ?>" alt="<?php echo $nombre ?>">
                <h1><?php echo ($nombre) ?></h1>
                <span><?php echo ($precio) ?> €</span>
                <p class="parrafo"><?php echo ($descripcion)  ?></p>
                <!-- <a class="peliculas__article__button" href="cesta.php?peliculaId=<?php echo $peliculaId ?> ">Comprar</a> -->
            </article>
        </section>

        <section class="comentarios">
            <?php if ($userLogged) { ?>
                <form method="post">
                    <div class="container">
                        <textarea name="comentario" rows="5" class="comentario" placeholder="comentar la pelicula <?php echo $nombre ?> "></textarea>

                        <button type="submit" name="action" value="comment_add" class="bookmarkBtn">
                            <span class="IconContainer">
                                <svg fill="white" viewBox="0 0 512 512" height="1em">
                                    <path d="M123.6 391.3c12.9-9.4 29.6-11.8 44.6-6.4c26.5 9.6 56.2 15.1 87.8 15.1c124.7 0 208-80.5 208-160s-83.3-160-208-160S48 160.5 48 240c0 32 12.4 62.8 35.7 89.2c8.6 9.7 12.8 22.5 11.8 35.5c-1.4 18.1-5.7 34.7-11.3 49.4c17-7.9 31.1-16.7 39.4-22.7zM21.2 431.9c1.8-2.7 3.5-5.4 5.1-8.1c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208s-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6c-15.1 6.6-32.3 12.6-50.1 16.1c-.8 .2-1.6 .3-2.4 .5c-4.4 .8-8.7 1.5-13.2 1.9c-.2 0-.5 .1-.7 .1c-5.1 .5-10.2 .8-15.3 .8c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4c4.1-4.2 7.8-8.7 11.3-13.5c1.7-2.3 3.3-4.6 4.8-6.9c.1-.2 .2-.3 .3-.5z"></path>
                                </svg>
                            </span>
                            <p class="text">Enviar comentario</p>
                        </button>
                    </div>

                </form>
            <?php  } else { ?>
                <a href="login.php">Quieres comentar registrate?</a>

            <?php } ?>
            <?php foreach ($comentarios as $comentario) {
                $nombre = $comentario['nombre_usuario'];
                $texto = $comentario['comentario'];
                $fecha = $comentario['fecha'];
            ?>
                <p>comentario de <?php echo $nombre ?> </p>
                <p> <?php echo $texto ?></p>
                <p><?php echo $fecha ?></p>
                <hr>
            <?php } ?>
        </section>
    </main>
    <?php include_once '../resources/footer.php' ?>

</body>

</html>