<?php

use App\ActualizarPelicula;
use App\Admin\Auth;
use App\ObtenerPeliculas;

include_once '../../vendor/autoload.php';
Auth::mustBeLogged();
$peliculaId = $_GET['pelicula_id'] ?? null;

if (!$peliculaId) {
	header("HTTP/1.0 404 Not Found");
	die('pelicula no existe');
}

$action = $_POST['action'] ?? null;

if ($action === 'update') {
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$precio = $_POST['precio'];
	$genero = $_POST['genero'];


	ActualizarPelicula::actualizar($peliculaId, $nombre, $descripcion, $precio, $genero);
}

$pelicula = ObtenerPeliculas::get($peliculaId);

if (!$pelicula) {
	header("HTTP/1.0 404 Not Found");
	die('pelicula no existe');
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>editar producto</title>
	<link rel="stylesheet" href="/css/login.css" />
</head>

<body class="body">
	<main class="main">
		<section class="main__section">
			<form
				class="form"
				method="post">
				<h1 class="h1">editar pelicula</h1>

				<div class="input__container">
					<label class="warp__label">
						Nombre
						<input class="input" type="text" name="nombre" value="<?php echo $pelicula->nombre ?>" required />
					</label>
				</div>

				<div class="input__container">
					<label class="form__label">
						descripcion
						<textarea class="input" name="descripcion" required>
							<?php echo $pelicula->descripcion ?>
						</textarea>
					</label>
				</div>

				<div class="input__container">
					<label class="warp__label">
						Precio
						<input class="input" type="number" name="precio" value="<?php echo (float)$pelicula->precio ?>" required />
					</label>
				</div>

				<div class="input__container">
					<label class="warp__label">
						Genero
						<input class="input" type="text" name="genero" value="<?php echo $pelicula->genero ?> " required />
					</label>
				</div>
				<button class="button" type="submit" name="action" value="update">Modificar peliculas</button>
			</form>
		</section>
	</main>
</body>

</html>