DROP DATABASE IF EXISTS peliculasIntermodular;
CREATE DATABASE peliculasIntermodular;

USE peliculasIntermodular;

CREATE TABLE peliculas (
pelicula_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(100) NOT NULL, 
precio DECIMAL (6,2) NOT NULL,
descripcion TEXT,
imagen MEDIUMBLOB
);

CREATE TABLE carrito (
    carrito_id VARCHAR(255) NOT NULL PRIMARY KEY
);

CREATE TABLE carrito_item(
    carrito_item_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    carrito_id  VARCHAR(255) NOT NULL,
    pelicula_id BIGINT UNSIGNED NOT NULL,
    cantidad INT UNSIGNED NOT NULL,
    FOREIGN KEY (carrito_id) REFERENCES carrito (carrito_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (pelicula_id) REFERENCES peliculas (pelicula_id) ON DELETE CASCADE ON UPDATE CASCADE

);


ALTER TABLE peliculas ADD FULLTEXT(nombre);
