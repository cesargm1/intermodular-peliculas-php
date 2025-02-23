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

    public static function searchPeliculas(string $buscador, array $generos): array
    {
        $conn = Connection::conn();

        $query = "SELECT * FROM peliculas";

        $wheres = [];

        if ($buscador != '') {
            // CUENTA EL NUMERO DE PALABRAS
            $trozos = explode(" ", $buscador);
            $numero = count($trozos);
            if ($numero == 1) {

                // SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE
                $wheres[] = "nombre LIKE '%$buscador%'";
            } elseif ($numero > 1) {
                //SI HAY UNA FRASE SE UTILIZA EL ALGORTIMO DE BUSQUEDA AVANZADO DE MATCH AGAINST
                // busqueda de frases con mas de una palabra y un algoritmo especializado
                $wheres[] = "MATCH (nombre) AGAINST  ('%$buscador%')";
            }
        }

        if ($generos) {
            $generosString =  "'" . implode("','", $generos) . "'";

            $wheres[] = "genero IN (" . $generosString . ")";
        }

        if ($wheres) {
            $wheresStr = implode(' AND ', $wheres);

            $query = $query . " WHERE " . $wheresStr;
        }

        $result =  $conn->query($query . " LIMIT 10");

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function generos(): array
    {
        $conn = Connection::conn();
        $query = "SELECT genero, COUNT(*) n FROM peliculas GROUP BY genero ";
        $result = $conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
