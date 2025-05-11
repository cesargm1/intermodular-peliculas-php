DELIMITER $$
CREATE TRIGGER trigger_peliculas_historico 
AFTER INSERT ON peliculas
FOR EACH ROW
BEGIN 
   INSERT INTO peliculas_historico (nombre, precio, genero, descripcion, imagen, fecha)
   VALUES ( NEW.nombre, NEW.precio, NEW.genero, NEW.descripcion, NEW.imagen, CURDATE());
END; $$