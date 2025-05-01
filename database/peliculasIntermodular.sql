DROP DATABASE IF EXISTS peliculasIntermodular;
CREATE DATABASE peliculasIntermodular;

USE peliculasIntermodular;

CREATE TABLE peliculas (
pelicula_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(100) NOT NULL, 
precio DECIMAL (6,2) NOT NULL,
 genero ENUM(
        'accion', 
        'aventura', 
        'comedia', 
        'drama', 
        'terror', 
        'ciencia ficcion', 
        'fantasia', 
        'suspenso', 
        'romance', 
        'musical', 
        'documental', 
        'animacion', 
        'misterio', 
        'historico', 
        'crimen'
    ),
descripcion TEXT,
imagen MEDIUMBLOB
);



CREATE TABLE usuarios (
    usuario_id BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    direccion_envio VARCHAR(255),
    telefono char(12),
    password VARCHAR(100),
    rol ENUM('admin', 'usuario')  NOT NULL DEFAULT 'usuario'

);

CREATE TABLE carrito (
    carrito_id VARCHAR(255) NOT NULL PRIMARY KEY,
    usuario_id BIGINT UNSIGNED,
    FOREIGN KEY (usuario_id) REFERENCES usuarios (usuario_id) ON DELETE CASCADE
);

CREATE TABLE carrito_item(
    carrito_item_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    carrito_id  VARCHAR(255) NOT NULL,
    pelicula_id BIGINT UNSIGNED NOT NULL,
    cantidad INT UNSIGNED NOT NULL,
    FOREIGN KEY (carrito_id) REFERENCES carrito (carrito_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (pelicula_id) REFERENCES peliculas (pelicula_id) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE(carrito_id, pelicula_id)

);

CREATE TABLE lista_deseos (
    usuario_id BIGINT UNSIGNED NOT NULL UNIQUE,
    pelicula_id BIGINT UNSIGNED NOT NULL UNIQUE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios (usuario_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (pelicula_id) REFERENCES peliculas (pelicula_id) ON DELETE CASCADE ON UPDATE CASCADE
);


ALTER TABLE peliculas ADD FULLTEXT(nombre);