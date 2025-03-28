<?php

namespace App;

class Carrito
{
    public function __construct() {}

    public function agregar(int $peliculaId)
    {
        $this->crearCarrito();
        $this->agregarPeliculaCarrito($peliculaId);
    }

    public function quitar(int $peliculaId)
    {
        $conn = Connection::conn();
        $sesion = new Session();
        $sesionId = $sesion->getId();

        $query = "UPDATE carrito_item SET cantidad = cantidad - 1  WHERE carrito_id = ? AND pelicula_id = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('sd', $sesionId, $peliculaId);

        $result = $stmt->execute();

        $query = "DELETE FROM carrito_item WHERE cantidad = 0 AND carrito_id = ? AND pelicula_id = ? ";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('sd', $sesionId, $peliculaId);

        $result = $stmt->execute();
    }


    public function peliculas(): array
    {

        $conn = Connection::conn();
        $sesion = new Session();
        $sesionId =  $sesion->getId();
        $query = "SELECT * FROM carrito_item  INNER JOIN peliculas ON carrito_item.pelicula_id = peliculas.pelicula_id WHERE carrito_id = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $sesionId);
        $stmt->execute();


        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function tiene()
    {
        $conn = Connection::conn();
        $sesion = new Session();
        $sesionId =  $sesion->getId();
        $query = "SELECT carrito_id FROM carrito WHERE carrito_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $sesionId);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function asociarUsuario(int $usuarioId)
    {
        $conn = Connection::conn();
        $sesion = new Session();
        $sesionId =  $sesion->getId();
        $query  = "update carrito set usuario_id= ? WHERE carrito_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('is', $usuarioId, $sesionId);
        return $stmt->execute();
    }


    private function crearCarrito()
    {
        if ($this->tiene()) {
            return;
        }

        $conn = Connection::conn();
        $sesion = new Session();
        $sesionId = $sesion->getId();
        $query = "INSERT INTO carrito (carrito_id) VALUES (?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $sesionId);

        return $stmt->execute();
    }

    private function agregarPeliculaCarrito(int $peliculaId)
    {
        $conn = Connection::conn();
        $sesion = new Session();
        $sesionId = $sesion->getId();
        $cantidad = 1;
        $query = "INSERT INTO carrito_item (carrito_id, pelicula_id, cantidad ) VALUES (?,?,?) ON DUPLICATE KEY UPDATE cantidad = cantidad + 1";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('sdd', $sesionId, $peliculaId, $cantidad);

        return $stmt->execute();
    }
}
