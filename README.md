# Proyecto Intermodular

Puedes previsualizar como quedo este proyecto visitando la web:

[https://peflix.cesargb.dev/](https://peflix.cesargb.dev/)

## Importar base de datos

```bash
mysql -u root < database/peliculasIntermodular.sql
```

## Customizar el acceso a la base de datos

Crea en la raiz del proyecto el fichero .env

```env
DB_USERNAME=root
DB_PASSWORD=
```

## Instalar

```bash
composer install
```

## Ejecutar vservidor

```bash
composer server
```

## Tratamiento de imagenes capcha

> [!IMPORTANT]
> Para que funcione el capcha descomentar en el archivo php.ini la linea 922 para que php pueda trabajar con imagenes y luego reiniciar el servidor:

Informacion sobre cada rama y commits en: [Distribucion de cada rama](RAMAS.md)

## Codigo fuente

[Repositorio Github](https://github.com/cesargm1/intermodular-peliculas-php.git)
