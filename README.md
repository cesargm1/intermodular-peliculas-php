# Proyecto Intermodular

Puedes previsualizar como quedo este proyecto visitando la web:

[https://peflix.cesargb.dev/](https://peflix.cesargb.dev/)

## Instalar

```bash
composer install
```

## Ejecutar vservidor

```bash
composer server
```

## Customizar el acceso a la base de datos

Crea en la raiz del proyecto el fichero .env

```env
DB_USERNAME=root
DB_PASSWORD=
```

## Importar base de datos

```bash
mysql -u root < database/peliculasIntermodular_con_ejemplos.sql
```
