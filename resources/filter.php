<?php

use App\ObtenerPeliculas;

include_once '../vendor/autoload.php';

$generos = ObtenerPeliculas::generos();

?>

<form class="filters" action="/buscador.php" method="get">

    <?php

    foreach ($generos as $genero) {
        $name = $genero['genero'];
        $count = $genero['n'];

    ?>
        <label>

            <input type="checkbox" name="genero[]" value="<?php echo $name ?>">
            <?php echo $name . ' (' . $count . ')' ?>
        </label>

    <?php } ?>

    <button class="filter" type="submit">Filtrar</button>

</form>