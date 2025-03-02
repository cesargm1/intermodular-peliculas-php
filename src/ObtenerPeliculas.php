<?php

namespace App;


class ObtenerPeliculas
{
    public static function getAll(): array
    {
        $conn = Connection::conn();
        $query = "SELECT * FROM  peliculas ORDER BY nombre";
        $result = $conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function count(): int
    {
        $conn = Connection::conn();
        $query = "SELECT COUNT(*) n FROM peliculas";

        $result = $conn->query($query);
        return  $result->fetch_assoc()["n"];
    }

    /**
     * moestra el numero actual de la pagina
     *
     * @param integer $page
     * @param integer $perPage
     * @return array
     */
    public static function paginate(int $page = 1,  int $perPage = 10): array
    {
        $conn = Connection::conn();
        // evita numeros negativos
        $page = max(1, (int) $page);
        $perPage = max(1, (int) $perPage);

        $start = ($page - 1) * $perPage;
        $query = "SELECT * FROM peliculas LIMIT $start , $perPage";
        $result = $conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Obtener numeros de paginas en funcion de los productos a mostrar
     *
     * @param integer $perPage  numero de productos a mostrar
     * @return integer
     */
    public static function numPages(int $perPage = 10): int
    {
        $perPage = max(1, (int) $perPage);

        $numPeliculas = self::count();

        return ceil($numPeliculas / $perPage);
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

    public static function lastFilms(int $perPage = 3): array
    {
        $conn = Connection::conn();
        $query = "SELECT * FROM peliculas ORDER BY pelicula_id DESC LIMIT $perPage ";
        $result = $conn->query($query);
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
