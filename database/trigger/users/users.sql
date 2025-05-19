-- Creacion
-- admin--
CREATE USER 'peflix_admin'@'%' IDENTIFIED BY 'peflixAdmin!';
-- usuario--
CREATE USER 'peflix_user'@'%' IDENTIFIED BY 'peflixUser!';
-- visitante --
CREATE USER 'peflix_guest'@'%' IDENTIFIED BY 'peflixGuest!';

-- Permisos

GRANT SELECT ,INSERT ON peliculasIntermodular.* TO 'peflix_user'@'%';
GRANT SELECT ON peliculasIntermodular.* TO 'peflix_guest'@'%';
GRANT ALL PRIVILEGES  ON peliculasIntermodular.* TO 'peflix_admin'@'localhost';


-- quuotas

ALTER USER 'peflix_user'@'%' WITH MAX_QUERIES_PER_HOUR 1000;
ALTER USER 'peflix_guest'@'%' WITH MAX_QUERIES_PER_HOUR 200;
ALTER USER 'peflix_admin '@'%' WITH MAX_QUERIES_PER_HOUR 500;
