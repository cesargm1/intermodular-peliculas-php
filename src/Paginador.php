<?php

namespace App;

class Paginator
{
    public static function AllResults(): array
    {
        $conn = Connection::conn();
        $query = "SELECT * FROM  peliculas";
        $result = $conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function calcAllPages($total, $limit)
    {
        return ceil($total / $limit);
    }

    public static function CurrentPage($page)
    {
        return isset($page) ? (int) $page : 1;
    }

    public static function linksPage($page, $limit)
    {
        $conn = Connection::conn();
        // evita numeros negativos
        $page = max(1, (int) $page);
        $start = ($page - 1) * $limit;
        $query = "SELECT * FROM peliculas LIMIT $start , $limit";
        $result = $conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
