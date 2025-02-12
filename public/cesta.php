<?php

use App\Carrito;

include_once '../vendor/autoload.php';

$peliculaId = $_GET['peliculaId'];

$agregarPeliculaCarrito = new Carrito();

$agregarPeliculaCarrito->agregar($peliculaId);
