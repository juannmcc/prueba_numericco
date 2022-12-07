# prueba_numericco

Se ha generado un proyecto en Symfony, que funciona mediante Command para la importación y exportación de datos.

A través de los comandos:

php bin/console app:ImportarDatos
php bin/console app:ExportarDatos

Ambos comandos generan las distintas ejecuciones:

La importación filtra los datos de los premios, y genera una lista de un millón de códigos distintos para incluirlos en la base de datos.
Se generaron dos tablas/entidades: Premios y Codigos.

Una vez incluídos los datos, se puede proceder a exportar los datos, y esto lee los datos de la tabla Códigos, y la exportar en un nuevo Csv de datos.


