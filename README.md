# To-do-list

_To-do-list desarrollado con Laravel 8 y Nuxt.js._

## Comenzando 🚀

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._

_Instalamos dependencias necesarias con Composer_

```
composer install
```

_Generamos archivo .env y completamos con nuestros datos_

```
cp .env.example .env
```

_Generamos key de Laravel_

```
php artisan key:generate
```
_Hacemos las migraciones correspondientes y ejecutamos los seeders_

```
php artisan migrate --seed
```
_Iniciamos servidor_

```
php artisan serve --host localhost
```

### Instalación SPA 🔧

_Una vez clonado el respositorio en tu máquina local, debés seguir los siguientes pasos:_

```
cd resources/spa
```
_Instalamos dependencias:_

```
npm i
```
_Generamos archivos Nuxt_

```
npm run dev
```
## Credenciales de acceso 🔓

_Administrador:_
```
email: admin@example.com
password: password
```

## Construido con 🛠️

_Menciona las herramientas que utilizaste para crear tu proyecto_

* [Laravel 8](https://laravel.com/) - Framework PHP
* [Nuxt.js](https://nuxtjs.org/) - Framework Javascript
* [Composer](https://getcomposer.org/doc/) - Manejador de dependecias PHP
* [NPM](https://www.npmjs.com/) - Manejador de dependencias Javascript

## Autor ✒️

* **Ramiro Driussi**

