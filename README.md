Blaster v2 README.MD

REQUISITOS
- php 8.1
- laravel 9


INSTALACIÓN:

1.- Clone el proyecto

2.- Cambie al directorio del proyecto recién clonado.

3.- Instale las dependencias:

composer install

4.- Cree el nuevo fichero /databases/my_db.sqlite  (o el nombre que usted prefiera)

5.- Configure el acceso a la base de datos

Haga una copia de: example.env.example y renombre a:.env

Configure el acceso a su base de datos dentro del fichero .env

DB_CONNECTION=sqlite

DB_DATABASE=
Escriba aquí el path a la base de datos. Quizás deba usar el camino completo.

6.- Genere la clave del proyecto:

php artisan key:generate

7.- Ejecute las migraciones y siembre los datos:

php artisan migrate --seed

8.- Inicialize su servidor web local

9.- Acceda al panel administrativo:
http://tudominio/login

usuario:	  admin@website.com
contraseña:   12345678

Puedes cambiar tu nombre, correo y contraseña en el tablero principal.

10.- Coloca la URL de tu plantilla principal en el panel de administración para tener una vista previa del mismo.

(Ejemplo: http://tudominio/)


Nota:  Quizás deba usar  http://tudomino/public en lugar de http://tudominio/, dependiendo de tu servidor web.


Disfrútalo!

# agence_prueba
