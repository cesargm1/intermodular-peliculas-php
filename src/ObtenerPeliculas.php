<?php

namespace App;


class ObtenerPeliculas
{
    public static function get(): array
    {
        $conn = Connection::conn();
        $query = "SELECT * FROM  peliculas ORDER BY nombre";
        $result = $conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function serchPeliculas(string $buscador): array
    {
        $conn = Connection::conn();

        if ($buscador != '') {
            //CUENTA EL NUMERO DE PALABRAS
            $trozos = explode(" ", $buscador);
            $numero = count($trozos);
            if ($numero == 1) {

                //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE
                $cadbusca = "SELECT * FROM peliculas WHERE  /*VISIBLE =1 AND*/ nombre LIKE '%$buscador%' LIMIT 10";
            } elseif ($numero > 1) {
                //SI HAY UNA FRASE SE UTILIZA EL ALGORTIMO DE BUSQUEDA AVANZADO DE MATCH AGAINST
                //busqueda de frases con mas de una palabra y un algoritmo especializado
                $cadbusca = "SELECT * FROM peliculas WHERE MATCH (nombre) AGAINST  ('%$buscador%')";
            }

            $result =  $conn->query($cadbusca);
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }
}
