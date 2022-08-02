# Notas Aulas 
## Sección 4 - Introducción a las rutas
### Aula 87 - Controladores en las carpetas
Todo ok
### Aula 86 - Rutas de tipo recurso y presenter: Opciones, only, except
Todo ok. Atención a la sintaxis de los elementos que hagan parde del only/except.
### Aula 85 - Rutas automáticas
Todo ok. 
### Aula 84 - Rutas de tipo resource y presenter
Todo ok. 
### Aula 83 - Probar rutas: tipo PUT
Esta práctica estuvo ok, pero parece que el único propósito es mostrar que no se puede usar el PUT. 
¯\_(ツ)_/¯
### Aula 82 - Probar rutas: tipo POST
Todo Ok
### Aula 81 - Comando para listado de rutas
Todo Ok
### Aula 80 - Argumentos en las rutas
Todo Ok
### Aula 79 - Rutas comunes
Todo Ok
### Aula 78 - Introduccion
Todo Ok
<details><summary>Sección 3 - Creando nuestro CRUD</summary>

## Sección 3 - Creando nuestro CRUD
Toda esta seccion y las anteriores se trabajaron en ambiente separado que se encuentra en la aplicacion `ci4dc`
### Aulas 76 y 77
Todo Ok
### Aula 75 - Validar datos de formulario mediante una clase aparte
Todo ok
### Aula 74 - Listado de categorías en actualizar película
Todo ok en la práctica.

Sin embargo, recuerdo que en aulas anteriores el profesor comentó que no entendía por que el uso del nombre de la tabla junto al id _ex:_ `category_id` en la tabla `categories` _(concepto básico de modelado de bases de datos)_, y en esta clase _(aunque existe el workaround)_ ocurre justamente lo que se quiere evitar con eso, que son los conflictos de nombres al realizar queries de SQL.

Para el caso, en la video aula el profesor tiene en dos tablas distintas `movies` y `categories` un campo con el mismo nombre `title`.

Así, al hacer una consulta join, habrá un conflicto de perdida de datos pués solo se almacenará uno de los dos campos title (esto por que de forma abstracta se crea una unica variable title y un dato sobre escribirá el otro), esto acontece pues el campo title que retornara será el de la última unión, ya que este query funciona de forma LIFO (Last In First Out).

Previendo este resultado, y siguiendo las buenas prácticas de programación y SQL, en mis tablas, estos campos desde el inicio de las aulas fueron llamados `movie_title` dentro de la tabla *movies* y `category_name` dentro de la tabla *categories*.

### Aula 73 - Listado de categorías en actualizar película
Todo Ok

En esta aula enseñan algo bien particular de PHP _(no de codeigniter)_, que es la forma como se usan los condicionales abreviados `(PHP Ternary Operator AKA PHP Shorthand If / Else)`
```php
$result = condition ? value1 : value2;
```
En esa forma de uso del condicional, PHP evalua la condición. Si es verdadero, retorna `value1`; en caso contrario, retorna `value2`, y ese valor es asignado/retornado a la variable `$result`.

De esa forma, en el ejercicio de la clase, la instrucción
```php
<?= $movie->category_id !== $c->category_id ?: " selected" ?>
```
es equivalente a esta otra pero de forma abreviada
```php
<?= $movie->category_id == $c->category_id ? " selected" : "" ?>
```
o en su forma extendida
```php
if($movie->category_id == $c->category_id)
{
 echo "selected";
}
else
{
 echo "";
}
```
### Aula 72 - Crear listado de categorías
Todo Ok
### Aula 71 - Crear seeder para las categorías
Todo Ok
### Aula 70 - Modificar migración de movie para las categorías: rollback y refresh
Todo Ok
### Aula 69 - Verificar id Nulo
Todo ok
### Aula 68 - Crear carpeta para guardar imágenes
Todo ok
### Aula 67 - Personalizar formulario de creación/edición
Todo ok.
Desde las vistas de `edit.php` y `new.php` enviamos un parametro a la vista del `archivo _form.php` que determina si se esta creando o actualizando el registro y de esta forma imprime o no algunos campos.
### Aula 66 - Redirección a actualizar en vista de creación
Todo ok.
**Observaciones importantes**

1. El metodo `save` no sirve cuando se requiere obtener el ID del objeto creado, es necesario cambiarlo por `insert`.

2. Al concatenar valores en las URL hubo que usar comillas `"`
```php
return redirect()->to("dashboard/movie/edit/$id")
```
eso por que usando apostrofes `'` y concatenando con `.` generó conflictos `¯\_(ツ)_/¯`
```php
return redirect()->to('dashboard/movie/edit/'.$id)
```
### Aula 65 - Cargar imágenes y registrar en la base de datos
Todo OK
### Aula 64 - Crear tabla (migración) para guardar imágenes
Todo Ok
### Aula 63 - Validaciones adicionales al momento de cargar la imagen
El metodo sugerido funciona para validar el tipo de archivo, sin embargo no es posible ver los mensajes "ECHO" que sugiere el profesor sin anular los retornos de la funcion de update/create, y para hacerlo por session tendriamos que modificar mucho el codigo de ejemplo entregado en el aula.
Para no afectar el contenido a seguir, la validacion se hizo cargando los archivos en ambos casos pero agregando el sufijo `Errado-` al inicio del nombre del archivo.

```php
if ($imagefile->isValid() && ! $imagefile->hasMoved())
{
    $validated = $this->validate([
        'image' => [
            'uploaded[image]',
            'mime_in[image,image/jpg,image/jpeg,image/gif,image/png]',
            'max_size[image,4096]',
        ],
    ]);

    if ($validated) {
        $newName = $imagefile->getRandomName();
        $imagefile->move(WRITEPATH . 'uploads', $newName);
    }else{
        $newName = 'Errado-'.$imagefile->getRandomName();
        $imagefile->move(WRITEPATH . 'uploads', $newName);
    }
    
}
```
### Aula 62 - Cargar imágenes o archivos
Todo ok. Para los formularios que cargan archivos, no olvidar incluir el atributo `enctype="multipart/form-data"` en la tag del form.
### Aula 61 - Botón para crear
En aulas anteriores yo habia creado un link en el header para la página de creacion, en esta aula se usa un metodo diferente para hacer lo mismo.

El código que yo habia creado para imprimir el link en el header, llamaba a una ruta de esta forma:
```php
<a href="<?= route_to('nuevaPelicula','') ?>">Nueva Peli</a>
```

Pero, en esta video aula se llamó a la funcion de crear de forma directa, es decir sin usar las rutas de CodeIgniter. Eso se hizo usando el código:
```php
<a href="movie/new">Crear</a>
```

### Aula 60 - Crear partials para los mensajes de sesión y errores de formulario
En general todo ok, pero con el detalle que los mensajes de session al **Editar** están generando doble salida en el header
### Aula 59 - Definir un formulario base para la creación y actualización
_**De la video aula**_

Todo ok

_**Por mi lado**_

Tuve la necesidad de remover el **index.php** de las URLS.

Para suprimir la cadena `index.php` de la URL en los redirects, en el archivo `app/Config/App.php` cambié la configuracion de la pagina de index asi:

De:
```PHP
public $indexPage = 'index.php';
```
Para:
```PHP
public $indexPage = '';
```
Y agregué un archivo .htaccess en la carpeta Raiz con los Rewrites
```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]
```
Tal cual indica la documentación oficial en: 
http://www.codeigniter.com/user_guide/general/urls.html#apache-web-server


### Aula 58 - Actualizar: valores por defecto y anterior en el formulario
Todo ok
### Aula 57 - Actualizar: Crear funciones y vistas asociadas
De **CI v4.0-RC3** para  **CI v4.2.1**, cambió la estructura de la ruta del método GET para actualizar datos.

En **CI v4.0-RC3** la estructura tenia el **keyvalue en el medio de la URL**
```SHELL
 GET    | dashboard/movie/(.*)/edit   | \App\Controllers\Movie::edit/$1                      |

```
En **CI v4.2.1** la estructura la estructura tiene el **keyvalue en el final de la URL**
```SHELL
 GET    | dashboard/movie/edit/(.*)   | \App\Controllers\Movie::edit/$1                      |
```

### Aula 56 - Eliminar registros
En la video aula usan **CI v4.0-RC3** , en la practica estoy usando **CI v4.2.1**.
Al darle clic al botón del formulario genera un error que dice
> 404 - File Not Found
>Can't find a route for 'get: dashboard/movie/delete'.

Después de mucho indagar e intentar entender a que se referia el profesor con el uso de rutas presenter encontré esta referencia:

https://codeigniter.com/user_guide/incoming/restful.html#presenter-routes

Y, el profesor comentó lo siguiente:
>define tus rutas como presenter y no como recurso, si, en el video uso es la ruta de tipo recurso, grabe el curso al poco tiempo que salió C4 en cuyo momento era un desastre el manejo de las rutas, ya estoy trabajando en el curso para ir haciendo correcciones

Conclusión, para corregir los errores de las aulas 49 y 56 lo que hay que hacer es, dentro del grupo de rutas dashboard  cambiar
 ```PHP
 $routes->resource('movie');
 ```
 por
 ```PHP
 $routes->presenter('movie');
 ```

### Aula 55 - Formularios: Redirección y mensajes por sesión
Todo ok. Prestar especial atencion en el uso de variables de sesion!
### Aula 54 - Formularios: Campos permitidos para guardar o actualizar
En el modelo los campos deben ser identicos a como estan nombrados en la base de datos, en el controlador las variables que guarden los valores obtenidos por el GET tambien deben coincidir con el nombre de lços campos definidos en la base de datos.
### Aula 52. mostrar errores en la vista
Todo Ok, bueno tener en cuenta que la regla required se vuelve "implicita" cuando se le define un tamaño "minimo" al campo.
### Aula 51. Validar los datos
Todo Ok
### Aula 50. Recibir los datos
Todo Ok
### Aula 49. Definir el formulario para crear peliculas
En la video aula usan **CI v4.0-RC3** , en la practica estoy usando **CI v4.2.1**.
Al darle clic al boton del formulario genera un error que dice
> 404 - File Not Found
>Can't find a route for 'get: dashboard/movie/create'.

En el chat de la video aula en Discord dieron dos alternativas que no funcionaron.

1ra alternativa
```PHP
<?php namespace App\Controllers;

use App\Models\MovieModel;
use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;

class Movie extends ResourceController {
```

2da alternativa 
```PHP
$routes->group('dashboard', static function ($routes) {
   $routes->get('movie', 'Movie::index');
   $routes->get('movie/new', 'Movie::new');
   $routes->post('movie/create', 'Movie::create'); 
});
```
#### Solución
Una tercera alternativa fué crear la ruta perdida dentro del grupo dashboard despues del resource.
```PHP
$routes->group('dashboard', static function ($routes) {
    $routes->resource('movie');
    $routes->post('movie/create', 'Movie::create');
});
```
Lo que deja la duda siguiente.
¿Por que no funciona *create* si está definido de manera implícita al definir la ruta como resource.?

Al consultar por consola dice que esta declarada.
```SHELL
+--------+---------------------------+------------------------------------------------------+----------------+---------------+
| Method | Route                     | Handler                                              | Before Filters | After Filters |
+--------+---------------------------+------------------------------------------------------+----------------+---------------+
| GET    | /                         | \App\Controllers\Home::index                         |                | toolbar       |
| GET    | contacto/(.*)             | \App\Controllers\Home::contacto/$1                   |                | toolbar       |
| GET    | category                  | \App\Controllers\dashboard\CategoryController::index |                | toolbar       |
| GET    | dashboard/movie           | \App\Controllers\Movie::index                        |                | toolbar       |
| GET    | dashboard/movie/new       | \App\Controllers\Movie::new                          |                | toolbar       |
| GET    | dashboard/movie/(.*)/edit | \App\Controllers\Movie::edit/$1                      |                | toolbar       |
| GET    | dashboard/movie/(.*)      | \App\Controllers\Movie::show/$1                      |                | toolbar       |
| POST   | dashboard/movie           | \App\Controllers\Movie::create                       |                | toolbar       |
| PATCH  | dashboard/movie/(.*)      | \App\Controllers\Movie::update/$1                    |                | toolbar       |
| PUT    | dashboard/movie/(.*)      | \App\Controllers\Movie::update/$1                    |                | toolbar       |
| DELETE | dashboard/movie/(.*)      | \App\Controllers\Movie::delete/$1                    |                | toolbar       |
| CLI    | ci(.*)                    | \CodeIgniter\CLI\CommandRunner::index/$1             |                |               |
+--------+---------------------------+------------------------------------------------------+----------------+---------------+
```

### Aula 48. Crear nuestra función y estructura genérica para el controlador de películas
Todo ok
### Aula 47 - Rutas: Rutas de tipo recurso para el controlador Movie
Todo Ok
### Aula 46 - Rutas: Agrupar rutas
Todo Ok
### Aula 45 - paginar registros
Todo Ok
### Aula 44 - Más características del findAll()
Todo Ok
### Aula 43 - Crear la vista del listado de peliculas
Todo Ok
### Aula 42 - Intro a la sección 3
Todo Ok
</details>

<details><summary>Sección 2 - primeros pasos con Codeigniter 4</summary>

## Sección 2 - primeros pasos con Codeigniter 4
### Aula 38 - El archivo .env en codeigniter 4
Todo Ok
### Aula 37 - Modelo: Crear modelo para las categorias
Todo Ok
### Aula 36 - Modelo: Crear modelo para conectar a la base de datos
Todo Ok, Especial atención al uso de la extensión PHP NameResolver en VS Code para importar las clases.
### Aula 35 - Seeder: Generar muchos registros de prueba
Todo Ok 
### Aula 34 - Seeder: Truncar la tabla desde los seeder
Todo Ok
### Aula 33 - Seeder: Generar datos de prueba
En la video aula el archivo de clase MovieSeeder es creado manualmente, sin embargo en mi practica lo generé usando el comando spark 'make:seeder MovieSeeder', no hubo problema.
### Aula 32 - Migraciones: Revertir cambios / Rollback
Todo Ok
### Aula 31 - Migraciones: Crear la tabla categories
Todo Ok
### Aula 30 - Migraciones: Crear la tabla movies
Todo Ok
### Aula 29 - Presentación de la línea de comandos de CodeIgniter
En las aulas anteriores la ruta de navegación de "category" habia sido definida en el controlador como
```PHP
[$routes->get( **'/dashboard/category'** , 'dashboard\CategoryController::index');]
```
para dejarla dentro del dashboard.

Sin embargo, en el transcurso de la video aula 29 aparece como:
```PHP
[$routes->get(**'/category'**, 'dashboard\CategoryController::index');]
```
### Aula 28 - Crear la conexión a la base de datos
Todo Ok
### Aula 27 - Presentación de las migraciones para planificación de la Base de datos
Todo Ok
### Aula 26 - Bug en las rutas
[No hay bugs de este tipo en la version 4.2.1 de codeigniter], en la clase dice que habia un Bug al usar NamedRoutes para ubicar controladores con argumento (parametros) 4.0(RC) con la que se hiso el video. Sin embargo, al replicar el ejercicio todo esta ok en la versión 4.2.1.
### Aula 25 - Rutas: Rutas con nombre
Todo Ok
### Aula 24 - Rutas: Navegación entre páginas
Todo Ok
### Aula 23 - Rutas: Pasar datos a func. de controlad.
Todo Ok
### Aula 22 - Paso de datos controladores/vista
Todo Ok
### Aula 21 - Trabajar con multiples vistas
Todo Ok
### Aula 20 - Segundo controlador en carpeta aparte
Todo Ok
### Aula 19 - Segunda ruta, método en el controlador
Todo Ok
### Aula 18 - Primer controlador y ruta asociada
Todo Ok
### Aulas 9 a 17 - Teoria y presentacion del framework  parte II.
Conceptos básicos Ok
</details>

<details><summary>Sección 1 - Introduccion al curso</summary>

## Sección 1 - Introduccion al curso
### Aulas 1 a 8 - Teoria y presentacion del framework parte I.
Conceptos básicos Ok 
</details>

<details><summary>Contenido original del ReadMe inicial</summary>

# CodeIgniter 4 Application Starter

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](http://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [the announcement](http://forum.codeigniter.com/thread-62615.html) on the forums.

The user guide corresponding to this version of the framework can be found
[here](https://codeigniter4.github.io/userguide/).

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 7.4 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
</details>
