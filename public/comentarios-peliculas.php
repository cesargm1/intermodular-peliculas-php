<?php

use App\Comentarios;
use App\ObtenerPeliculas;

use App\User\Auth;
use App\Validator;
use App\ValidatorException;


include_once '../vendor/autoload.php';
$peliculaId = (int) ($_GET['peliculaId'] ?? '');
$pelicula = ObtenerPeliculas::get($peliculaId);
$nombre = $pelicula->nombre ?? '';
$peliculaId =  $pelicula->peliculaId ?? '';
$precio = $pelicula->precio ?? '';
$descripcion = $pelicula->descripcion ?? '';
$imagen = $pelicula->imagen ?? '';
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
    <link rel="stylesheet" href="/css/peliculas.css">
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
                    <textarea name="comentario" class="comentario" placeholder="comentar la pelicula <?php echo $nombre ?> "></textarea>
                    <button type="submit" name="action" value="comment_add">Enviar comentario</button>
                </form>
            <?php  } else { ?>
                <a href="/login">Quieres comentar registrate?</a>
                <!-- <p name="usuario">comentario de <?php echo $usuario ?> </p> -->
                <!-- <textarea name="comentario"></textarea> -->
                <!-- <p name="fecha"><?php echo $fecha ?></p> -->
            <?php } ?>

        </section>
    </main>
    <?php include_once '../resources/footer.php' ?>

</body>

</html>