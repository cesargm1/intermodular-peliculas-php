<?php

use App\Admin\Auth;

include_once '../../vendor/autoload.php';
Auth::mustBeLogged();
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
				action="/panel/crear_pelicula.php"
				method="post"
				enctype="multipart/form-data">
				<h1 class="h1">añadir peliculas</h1>

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

				<button class="button" type="submit">Insertar pelicula</button>
			</form>
		</section>
	</main>
</body>

</html>