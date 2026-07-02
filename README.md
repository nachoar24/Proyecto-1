# Proyecto 1 - Laravel From Scratch 2026

## ISW811 Aplicaciones Web con Software Libre

**Estudiante:** Ignacio Araya
**Curso:** ISW811 Aplicaciones Web con Software Libre
**Proyecto:** Laravel From Scratch 2026
**Repositorio:** https://github.com/nachoar24/Proyecto-1

---

## Descripción del proyecto

Este proyecto corresponde al desarrollo progresivo de una aplicación web utilizando Laravel, como parte del curso ISW811 Aplicaciones Web con Software Libre.

El proyecto sigue los episodios del curso Laravel From Scratch 2026 y aplica conceptos como rutas, vistas Blade, componentes, formularios, validación, base de datos, Eloquent ORM, autenticación, autorización, Vite, notificaciones, colas, pruebas automatizadas con Pest y desarrollo de un proyecto final.

---

## Tecnologías utilizadas

El proyecto utiliza las siguientes tecnologías y herramientas:

* Laravel
* PHP
* Composer
* MariaDB
* Blade
* Eloquent ORM
* Vagrant
* VirtualBox
* Apache
* Node.js
* NPM
* Vite
* TailwindCSS
* AlpineJS
* Pest
* Git

---

## Entorno de desarrollo

El proyecto fue desarrollado dentro de una máquina virtual administrada con Vagrant.

Ruta principal de la máquina virtual en el equipo local:

```text
~/ISW811/VMs/webserver
```

Ruta del proyecto Laravel dentro del equipo local:

```text
~/ISW811/VMs/webserver/sites/lfs.isw811.xyz
```

Ruta del proyecto Laravel dentro de la máquina virtual:

```text
~/sites/lfs.isw811.xyz
```

Dominio local utilizado:

```text
http://lfs.isw811.xyz
```

---

## Ingresar a la máquina virtual

Desde Git Bash:

```bash
cd ~/ISW811/VMs/webserver
vagrant ssh
```

Luego, dentro de la máquina virtual:

```bash
cd ~/sites/lfs.isw811.xyz
```

---

## Levantar el servidor frontend con Vite

Dentro de la máquina virtual y dentro del proyecto:

```bash
npm run dev -- --host 0.0.0.0
```

Este comando permite compilar y servir los assets CSS y JavaScript durante el desarrollo.

---

## Ejecutar pruebas con Pest

Dentro de la máquina virtual y dentro del proyecto:

```bash
./vendor/bin/pest
```

También se pueden ejecutar grupos específicos de pruebas:

```bash
./vendor/bin/pest tests/Feature
```

---

## Formatear código

El proyecto incluye un script de Composer para formatear código con Laravel Pint.

Dentro de la máquina virtual:

```bash
composer run format
```

---

## Limpiar caché de Laravel

Dentro de la máquina virtual:

```bash
php artisan optimize:clear
php artisan view:clear
```

---

## Base de datos

El proyecto utiliza MariaDB.

Base de datos configurada para el proyecto:

```text
lfs
```

Usuario utilizado:

```text
larauser
```

---

## Migraciones

Para ejecutar las migraciones:

```bash
php artisan migrate
```

Para reiniciar la base de datos y ejecutar migraciones nuevamente:

```bash
php artisan migrate:fresh
```

---

## Tinker

Para interactuar con los modelos desde consola:

```bash
php artisan tinker
```

Ejemplo utilizado durante el desarrollo para buscar un usuario específico:

```php
$user = App\Models\User::where('email', 'ignacio.araya@ejemplo.com')->first();
```

---

## Funcionalidades implementadas

Durante el desarrollo del proyecto se han implementado las siguientes funcionalidades:

* Rutas básicas en Laravel.
* Vistas Blade.
* Layout principal.
* Componentes Blade reutilizables.
* Formularios con protección CSRF.
* Validación de formularios.
* Form Request Classes.
* Migraciones.
* Modelos Eloquent.
* Operaciones CRUD iniciales.
* Controladores.
* Autenticación de usuarios.
* Middleware `auth` y `guest`.
* Relaciones entre usuarios e ideas.
* Autorización mediante Gates.
* Autorización mediante Policies.
* Directivas Blade relacionadas con autorización.
* Configuración de assets con Vite.
* Notificaciones.
* Uso básico de colas.
* Pruebas automatizadas con Pest.
* Inicio del proyecto final.
* Modelo de datos para el proyecto final.
* Uso de factories y enums.
* Interfaz inicial con TailwindCSS.
* Mensajes flash interactivos con AlpineJS.
* Tarjetas de ideas.
* Filtros de ideas por estado.
* Conteo de ideas por estado.

---

## Documentación

La documentación del proyecto se encuentra en la carpeta:

```text
docs/
```

Índice del Entregable 01:

```text
docs/entregable01.md
```

Índice del Entregable 02:

```text
docs/entregable02.md
```

Cada episodio cuenta con su propio archivo de documentación y sus respectivas capturas de pantalla.

Las capturas se encuentran en:

```text
docs/img/
```

---

## Entregables

### Entregable 01

Incluye los episodios 1 al 16.

Contenido principal:

* Fundamentos de Laravel.
* Rutas.
* Blade.
* Formularios.
* Validación.
* Base de datos.
* Eloquent.
* CRUD inicial.
* Autenticación básica.
* Middleware.
* Relaciones entre modelos.

### Entregable 02

Incluye los episodios 17 al 29.

Contenido principal:

* Autorización con Gates.
* Autorización con Policies.
* Vite.
* Notificaciones.
* Colas.
* Pruebas con Pest.
* Inicio del proyecto final.
* Modelo de datos del proyecto final.
* Interfaz inicial con TailwindCSS.
* AlpineJS.
* Tarjetas de ideas.
* Filtros de ideas por estado.

---

## Generar archivo comprimido del Entregable 02

Desde la carpeta que contiene el proyecto:

```bash
cd ~/ISW811/VMs/webserver/sites
```

Ejecutar:

```bash
tar cvfz ISW811_Proyecto1_Entregable02_ArayaIgnacio.tar.gz \
  --exclude=lfs.isw811.xyz/vendor \
  --exclude=lfs.isw811.xyz/node_modules \
  --exclude=lfs.isw811.xyz/.env \
  lfs.isw811.xyz/
```

Este comando incluye el proyecto completo y el repositorio Git con la carpeta `.git/`, pero excluye `vendor/`, `node_modules/` y `.env`.

---

## Consideraciones importantes

No se deben incluir en el entregable:

```text
vendor/
node_modules/
.env
```

Estos archivos o carpetas se excluyen porque pueden regenerarse o porque contienen información sensible.

El repositorio Git sí debe incluirse, por lo que no se debe excluir la carpeta:

```text
.git/
```

---

## Instalación de dependencias

Después de descomprimir el proyecto, las dependencias pueden instalarse nuevamente con:

```bash
composer install
npm install
```

Luego se pueden ejecutar migraciones:

```bash
php artisan migrate
```

Y levantar Vite:

```bash
npm run dev -- --host 0.0.0.0
```

---

## Comentarios finales

Este proyecto evidencia el avance acumulativo del curso Laravel From Scratch 2026, manteniendo documentación técnica por episodio, capturas de pantalla, commits por capítulo y una estructura organizada para facilitar la revisión del entregable.
