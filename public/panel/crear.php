<?php

use App\Admin\Auth;
use App\CrearPelicula;
use App\Validator;
use App\ValidatorException;

include_once '../../vendor/autoload.php';
Auth::mustBeLogged();


$messageError = '';
$action = $_POST['action'] ?? null;

if ($action === 'crear') {
	$nombre = $_POST['nombre'] ?? '';
	$descripcion = $_POST['descripcion'] ?? '';
	$precio = $_POST['precio'] ?? '';
	$genero = $_POST['genero'] ?? '';
	$imagen = $_FILES['imagen'] ?? '';


	try {
		$validatorName = new Validator($nombre, 'Nombre del producto');
		$validatorName->require();

		$validatorDescription = new Validator($descripcion, "descripcion del producto");
		$validatorDescription->require();

		$validatorPrecio = new Validator($precio, "Precio del producto");
		$validatorPrecio->require()->min(0);

		$validatorGenero = new Validator($genero, "Genero de la pelicula");
		$validatorGenero->require();

		$validatorImagen = new Validator($imagen['tmp_name'], "imagen del producto");
		$validatorImagen->require();

		$imagenContent = file_get_contents($imagen['tmp_name']);

		$creada = CrearPelicula::crear($nombre, $descripcion, $precio, $genero, $imagenContent);
	} catch (ValidatorException $exception) {
		$messageError = $exception->getMessage();
	}
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Crear productos</title>
	<link rel="stylesheet" href="/css/login.css" />
</head>

<body class="body">
	<main class="main">
		<section class="main__section">
			<form
				class="form"
				method="post"
				enctype="multipart/form-data">
				<h1 class="h1">añadir peliculas</h1>

				<?php
				if ($messageError) {
					echo "<span class='error'> $messageError </span>";
				}
				?>

				<div class="input__container">
					<label class="warp__label">
						Nombre
						<input class="input" type="text" name="nombre" required />
					</label>
				</div>

				<div class="input__container">
					<label class="form__label">
						descripcion
						<textarea class="input" name="descripcion" required></textarea>
					</label>
				</div>

				<div class="input__container">
					<label class="warp__label">
						Precio
						<input class="input" type="number" name="precio" required />
					</label>
				</div>

				<div class="input__container">
					<label class="warp__label">
						Genero
						<input class="input" type="text" name="genero" required />
					</label>
				</div>

				<div class="file__container">
					<label class="form__label__file">
						Insertar Imagen de la pelicula
						<input
							class="input__file input__container"
							type="file"
							accept="image/png, image/jpeg, image/webp"
							name="imagen"
							required />
					</label>
				</div>

				<button class="button" type="submit" name="action" value="crear">Insertar pelicula</button>
			</form>
		</section>
	</main>
</body>

</html>