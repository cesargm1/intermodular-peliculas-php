<?php

use App\Admin\Auth;
use App\EliminarPelicula;
use App\ObtenerPeliculas;

include_once '../../vendor/autoload.php';
Auth::mustBeLogged();

$action = $_POST['action'] ?? null;

if ($action === 'eliminar') {
	$peliculaId = (int)$_POST['pelicula_id'];
	EliminarPelicula::deletefilm($peliculaId);
}

$peliculas = ObtenerPeliculas::getAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Listado de peliculas</title>
	<link rel="stylesheet" href="/css/header.css">
	<link rel="stylesheet" href="/css/panel/tables.css">

</head>
<?php include_once '../../resources/panel/header.php' ?>

<body>
	<h1>Peliculas</h1>
	<a href="/panel/crear.php">Añadir nueva pelicula</a>
	<table>
		<tr>
			<th>#</th>
			<th>nombre</th>
			<th>precio</th>
			<th>genero</th>
			<th></th>
		</tr>

		<?php foreach ($peliculas as $pelicula) { ?>
			<tr>
				<td><?php echo $pelicula['pelicula_id'] ?></td>
				<td><?php echo $pelicula['nombre'] ?></td>
				<td><?php echo $pelicula['precio'] ?>€</td>
				<td><?php echo $pelicula['genero'] ?></td>
				<td>
					<a href="/panel/editar.php?pelicula_id=<?php echo $pelicula['pelicula_id'] ?>">editar pelicula</a>
					<form method="post">
						<input type="hidden" name="pelicula_id" value="<?php echo $pelicula['pelicula_id'] ?>">
						<input type="submit" name="action" value="eliminar">
					</form>

				</td>


			</tr>
		<?php } ?>
	</table>
</body>

</html>