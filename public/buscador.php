<?php

use App\ObtenerPeliculas;



if (!empty($_GET['buscador'])) {
    include_once '../vendor/autoload.php';

    $peliculas = ObtenerPeliculas::get();
    ObtenerPeliculas::serchPeliculas($_GET['buscador']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>buscador</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <input name="buscador" type="search">
        <button>buscar</button>
    </form>
    <h1>Peliculas</h1>

    <ul>
        <li><?php foreach ($peliculas as $pelicula) {
                echo var_dump($peliculas);
            } ?></li>
    </ul>