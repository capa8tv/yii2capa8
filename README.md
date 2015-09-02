Yii 2 Template Basic
============================

CLASE 1
-------

    1. Requisitos de Yii2
        1.1. PHP 5.4.0 o superior
        1.2. Mod_rewrite activado
        1.3 Librerías
            1.3.1 Ctype
            1.3.2 MBString
            1.3.3 PDO
            1.3.4 PDO-mysql - PDO-pgsql - PDO-sqlite PDO-MSSQL (al menos uno)
            1.3.5 GD
    2. Definición de Famework y Framework en desarrollo de software
    3. Definición del patrón Model View Controller - MVC (Modelo Vista Controlador)
    4. Instalación del template basic
    5. Estructura de directorios
    6. Generación del primer "hola mundo"



ESTRUCTURA DE DIRECTORIO
------------------------

      assets/             contiene definición de los assets
      commands/           contiene los comandos de consola (controladores)
      config/             contiene configuraciones de la aplicación
      controllers/        contiene las clases que funcionan de Controlador
      mail/               contiene los archivos que sirven de vistas para enviar correo electrónico
      models/             contiene las clases de los Modelos
      runtime/            contiene archivos que se generan durante al ejecución
      tests/              contiene varias pruebas para el template basic
      vendor/             contiene paquetes de terceros (extensiones)
      views/              contiene los archivos de vista para la aplicación web
      web/                contiene los scripts, css, imágenes y demás recursos



REQUERIMIENTOS DE INSTALACIÓN
-----------------------------

EL requerimiento mínimo es contar con PHP 5.4.0 o superior


INSTALACIÓN
------------

### Instalar vía Composer


```php
composer global require "fxp/composer-asset-plugin:~1.0.0"
composer create-project --prefer-dist yiisoft/yii2-app-basic yii2capa8
```

Puede acceder a la aplicación a través de la siguiente URL:

~~~
http://localhost/yii2capa8/web/
~~~

CLASE 2
-------

Veremos cómo poner la aplicación en español, instalaremos el template advanced,
veremos las diferencias entre los dos templates (basic y advanced),
trabajaremos con el url manager y crearemos nuestras primeras vistas


CONFIGURACIÓN
-------------

### Base de datos (esto lo veremos pronto)

Edite el archivo `config/db.php` con la configuración del servidor:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2capa8',
    'username' => 'yii2capa8',
    'password' => '123456',
    'charset' => 'utf8',
];
```

**NOTE:** Recuerden usar #ManosEnElCódigo en las redes sociales
