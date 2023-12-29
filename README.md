<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Instalación

Clonar el repositorio
Correr el comando composer install
Luego correr las migraciones con el comando "php artisan migrate"
Los seeders en este orden:
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=RegionSeeder
php artisan db:seed --class=CommuneSeeder

## Uso

El desarrollo y pruebas del proyecto se llevaron a cabo con Postman.

Primero apuntar a la url /api/login, con una solicitud POST, enviando un body/raw en formato JSON con los datos email y password, de esta manera:

{
    "email": "test@example.com",
    "password": "123456"
}

Siendo estos datos los correspondientes a la tabla users.
Esta petición nos devolverá una respuesta en formato JSON, con un token, el cuál deberá ser utilizado en los 3 servicios de la API, el cuál debe ser ingresado como un header con la key "Authorization".

Para registrar nuevos costumers, apuntar a la url /api/customer/register con una petición del tipo POST, enviando un body/raw en formato JSON, como este ejemplo:

{
    "dni": "12345619",
    "region_id": 1,
    "commune_id": 2,
    "email": "correo5@ejemplo.com",
    "name": "Nombre",
    "last_name": "Apellido",
    "address": "Dirección de ejemplo"
}

Para consultar costumers apuntar a la url /api/customer/get_record, con una petición GET. Se puede consultar por dni o por email. Enviar un body/raw en formato JSON, de esta manera:

{
    "dni": 12345611
}

o 

{
    "email": "correo3@ejemplo.com"
}

Por último, para borrar customers, apuntar a la url /api/customer/delete_record con una petición DELETE. Se envía un body/raw en formato JSON, como este:

{
        "dni": 12345655
}

La eliminación es lógica, pasando el registro de status A a "trash".









