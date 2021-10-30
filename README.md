# SIN EXCUSAS


## Tecnologías  🚀

**Laravel** 7




### Pre-requisitos 📋

_Que cosas necesitas para instalar el software y como instalarlas_

**Composer** 1.9

**Laravel** 7

**PHP** 7.2 minímo

### Instalación 🔧

_Pasos para la instalación_


_Clonar repositorio_
```
git@github.com:apprunn/dp6CmsEnel.git
```
_Instalar carpeta vendor_
```
composer install
```
_Paquetes externos_

```
composer require "laravelcollective/html":"^6.1"
```

```
composer require "tymon/jwt-auth":"^1.0"
```

```
composer require "doctrine/dbal":"^2.10"
```



## Iniciar el proyecto ⚙️

_Pasos para iniciar la base del proyecto_
```
php artisan migrate --seed
```
```
php artisan serve
```

## Endpoints 📋

_Listado de endpoints para el usuario y sus campos requeridos_
```
POST => '/login'  {"email":"","password":""}
POST => '/register' {"email":"","password":"", "external_enterprise":""}
GET  => '/logout'  {"token":""}
GET  => '/home'   
GET  => '/activation/{data}/{content}'
POST => '/forget-password'  {"email":""}
POST => '/reset-password'   {"email":"","password":"","password_confirmation":""}
```

_Listado de endpoints para acceeder a los recursos_
```
GET => '/courses'
GET => '/courses/{id}/units'
GET => '/units'
GET => '/units/{id}/questions'
GET => '/questions'
```
_Rutas que requieren token de autenticación_
```
POST => '/user-register-course'   {"course_id":"","init_date":"","insc_date":""}
GET = 'certificate/{id}/course/download'   Download pdf course
```

## Variables de entorno ⚙️

_Variables de entorno_
_Para la variable JWT_SECRET ejectutar el siguiente comando_
```
php artisan jwt:secret
```
```
JWT_SECRET=

RESET_PASSWORD_URL="http://localhost:8020/nueva-contrasena?email="

```
