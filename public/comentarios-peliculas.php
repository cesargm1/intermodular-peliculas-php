<?php

use App\Comentarios;
use App\ListarComentarios;
use App\ListarUsuarios;
use App\ObtenerPeliculas;

use App\User\Auth;
use App\Validator;


include_once '../vendor/autoload.php';
$peliculaId = (int) ($_GET['peliculaId'] ?? '');
$pelicula = ObtenerPeliculas::get($peliculaId);
$nombre = $pelicula->nombre ?? '';
$precio = $pelicula->precio ?? '';
$descripcion = $pelicula->descripcion ?? '';
$imagen = $pelicula->imagen ?? '';
$comentarios = ListarComentarios::get($peliculaId);
$userLogged = Auth::check();


$action = $_POST['action'] ?? null;

if ($action == 'comment_add') {
    $comentario = $_POST['comentario'] ?? '';
    $validator = new Validator($comentario, "Rellena el comentario para continuar");
    $validator->require();
    $comentario = Comentarios::insertComment($comentario, $peliculaId);
    $comentarioSeguro = htmlspecialchars($comentario, ENT_QUOTES, 'UTF-8');
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
    <main class=" main container">
        <section class="peliculas p-2 w-100">
            <div class="card">
                <div class="row g-0">
                    <div class="col-12 col-md-6 p-3">
                        <img class="peliculas__article__img card-img-top img-thumbnai" src="data:image/jpeg;base64,<?php echo $imagen ?>" alt="<?php echo $nombre ?>">
                    </div>

                    <div class="col-12 col-md-6 d-flex align-items-center">
                        <div class="card-body">
                            <h1 class="card-title"><?php echo ($nombre) ?></h1>
                            <span class="fs-3 text-primary"><?php echo ($precio) ?> €</span>
                            <p class="card-text"><?php echo ($descripcion)  ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="comentarios p-2">
            <?php if ($userLogged) { ?>
                <form method="post">
                    <section class="box-comment p-2">
                        <div class="form-floating">
                            <textarea class="form-control" name="comentario" placeholder="deja tu comentario aqui" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">enviar comentario sobre <?php echo $nombre ?>...</label>
                        </div>
                    </section>

                    <input name="peliculaid" type="hidden">
                    <div class="w-100 d-flex justify-content-end">
                        <button type="submit" class="btn btn-outline-primary m-2" value="comment_add">Enviar</button>
                    </div>
                </form>
            <?php  } else { ?>
                <a href="login.php">Quieres comentar registrate?</a>
            <?php } ?>
        </section>

        <section>
            <?php foreach ($comentarios as $comentario) {
                $nombre = $comentario['nombre_usuario'];
                $texto = $comentario['comentario'];
                $fecha = $comentario['fecha'];
            ?>

                <div class="card w-100 mb-3" style="width: 18rem;">
                    <div class="card-header">
                        comentario de <?php echo $nombre ?>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?php echo $texto ?></li>
                        <li class="list-group-item"><?php echo $fecha ?></li>
                    </ul>
                </div>
            <?php } ?>
        </section>

    </main>
    <?php include_once '../resources/footer.php' ?>

</body>

</html>