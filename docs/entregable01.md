# Proyecto 1 - Entregable 01

## ISW811 Aplicaciones Web con Software Libre

**Estudiante:** Ignacio Araya
**Curso:** ISW811 Aplicaciones Web con Software Libre
**Proyecto:** Laravel From Scratch 2026
**Entregable:** Entregable 01
**Episodios documentados:** 1 al 16
**Contenido:** Fundamentos de Laravel, Eloquent, CRUD inicial, validación y autenticación básica

---

## Descripción general

Este documento funciona como índice principal de la documentación correspondiente al Entregable 01 del Proyecto 1.

En este entregable se desarrollaron los fundamentos iniciales de una aplicación web moderna con Laravel, siguiendo los episodios 1 al 16 del curso Laravel From Scratch 2026.

El proyecto fue construido de forma progresiva y acumulativa, incorporando rutas, vistas Blade, componentes, formularios, validación, base de datos, Eloquent ORM, controladores, autenticación básica, middleware y relaciones entre modelos.

---

## Repositorio del proyecto

Repositorio en GitHub:

https://github.com/nachoar24/Proyecto-1

---

## Estructura de documentación

La documentación se encuentra organizada por episodio dentro de la carpeta `docs/`.

Los episodios 1 al 13 corresponden al módulo **The Fundamentals**.

Los episodios 14 al 16 corresponden al inicio del módulo **Authentication / Authorization**.

---

# I. The Fundamentals

## Episodio 01: Welcome Aboard

[Ver documentación del episodio 01](the-fundamentals/01-welcome-aboard.md)

En este episodio se realizó la introducción al curso Laravel From Scratch 2026 y se presentó el objetivo general del proyecto.

---

## Episodio 02: Set Up Your Development Environment

[Ver documentación del episodio 02](the-fundamentals/02-set-up-your-development-environment.md)

En este episodio se configuró el entorno de desarrollo utilizando Vagrant, VirtualBox, Apache, PHP, Composer y Laravel.

---

## Episodio 03: Routing 101

[Ver documentación del episodio 03](the-fundamentals/03-routing-101.md)

En este episodio se trabajó con rutas básicas en Laravel, incluyendo la ruta principal `/` y la ruta `/about`.

---

## Episodio 04: Layout Files

[Ver documentación del episodio 04](the-fundamentals/04-layout-files.md)

En este episodio se crearon layouts y componentes Blade para reutilizar estructura HTML en distintas vistas.

---

## Episodio 05: Pass Data to Views

[Ver documentación del episodio 05](the-fundamentals/05-pass-data-to-views.md)

En este episodio se aprendió a pasar datos desde rutas hacia vistas Blade.

---

## Episodio 06: Blade Directives

[Ver documentación del episodio 06](the-fundamentals/06-blade-directives.md)

En este episodio se utilizaron directivas Blade como `@if`, `@foreach`, `@forelse` y `@empty`.

---

## Episodio 07: Forms

[Ver documentación del episodio 07](the-fundamentals/07-forms.md)

En este episodio se crearon formularios en Laravel, utilizando métodos `POST` y protección CSRF.

---

## Episodio 08: Databases, Migrations, and Eloquent

[Ver documentación del episodio 08](the-fundamentals/08-databases-migrations-and-eloquent.md)

En este episodio se trabajó con migraciones, base de datos, modelos y Eloquent ORM para almacenar ideas.

---

## Episodio 09: HTTP Requests and REST

[Ver documentación del episodio 09](the-fundamentals/09-http-requests-and-rest.md)

En este episodio se reorganizaron las rutas para utilizar una estructura REST inicial con operaciones de creación, visualización, edición, actualización y eliminación.

---

## Episodio 10: Controllers

[Ver documentación del episodio 10](the-fundamentals/10-controllers.md)

En este episodio se creó un controlador para separar la lógica de las rutas y organizar mejor el código.

---

## Episodio 11: Request Validation

[Ver documentación del episodio 11](the-fundamentals/11-request-validation.md)

En este episodio se agregó validación de formularios para evitar guardar o actualizar ideas con datos inválidos.

---

## Episodio 12: Form Request Classes

[Ver documentación del episodio 12](the-fundamentals/12-form-request-classes.md)

En este episodio se movieron las reglas de validación a una clase Form Request dedicada.

---

## Episodio 13: A Brief DaisyUI Detour

[Ver documentación del episodio 13](the-fundamentals/13-a-brief-daisyui-detour.md)

En este episodio se mejoró la interfaz visual de la aplicación utilizando DaisyUI y componentes reutilizables.

---

# II. Authentication / Authorization

## Episodio 14: Authentication Explained

[Ver documentación del episodio 14](authentication-authorization/14-authentication-explained.md)

En este episodio se implementó autenticación básica con registro de usuarios, inicio de sesión, cierre de sesión y navegación condicional.

---

## Episodio 15: Require Authentication With Middleware

[Ver documentación del episodio 15](authentication-authorization/15-require-authentication-with-middleware.md)

En este episodio se protegieron las rutas de ideas utilizando middleware `auth` y se configuraron rutas para usuarios invitados mediante middleware `guest`.

---

## Episodio 16: Eloquent Relationships

[Ver documentación del episodio 16](authentication-authorization/16-eloquent-relationships.md)

En este episodio se implementaron relaciones de Eloquent entre usuarios e ideas, usando `belongsTo` y `hasMany`.

---

# Resumen de funcionalidades implementadas

Durante el Entregable 01 se implementaron las siguientes funcionalidades:

* Creación y ejecución de un proyecto Laravel funcional.
* Configuración de entorno local con Vagrant.
* Rutas básicas.
* Vistas Blade.
* Layout principal.
* Componentes Blade reutilizables.
* Paso de datos desde rutas y controladores hacia vistas.
* Uso de directivas Blade.
* Formularios con protección CSRF.
* Migraciones.
* Modelo Eloquent `Idea`.
* Operaciones CRUD básicas.
* Controlador `IdeaController`.
* Validación de formularios.
* Form Request Class `IdeaRequest`.
* Aplicación básica de estilos con TailwindCSS y DaisyUI.
* Registro de usuarios.
* Inicio de sesión.
* Cierre de sesión.
* Middleware de autenticación.
* Middleware para invitados.
* Relación entre usuarios e ideas mediante Eloquent.

---

# Evidencias

Las capturas de pantalla se encuentran almacenadas en la carpeta:

```text
docs/img/
```

Cada archivo de documentación por episodio incluye sus respectivas evidencias mediante imágenes en formato Markdown.

Las evidencias cubren:

* Página inicial del proyecto.
* Rutas creadas.
* Formularios funcionales.
* Listado de registros almacenados en base de datos.
* Creación, edición, actualización y eliminación de registros.
* Validaciones funcionando.
* Pantallas de registro, inicio de sesión y cierre de sesión.
* Middleware de autenticación.
* Relaciones de Eloquent entre usuarios e ideas.

---

# Instrucciones de ejecución

Las instrucciones para instalar y ejecutar el proyecto localmente se encuentran en el archivo principal:

[Ver README del proyecto](../README.md)

---

# Consideraciones técnicas

El proyecto utiliza Laravel, Blade, Eloquent ORM, MariaDB, TailwindCSS, DaisyUI, autenticación básica y middleware.

El archivo `.tar.gz` del entregable debe incluir el proyecto completo y el repositorio Git con la carpeta `.git/`.

No se deben incluir los directorios:

```text
vendor/
node_modules/
```

Tampoco se debe incluir el archivo `.env`, ya que puede contener información sensible.

---

# Comentarios finales

Este entregable evidencia el avance acumulativo de los primeros 16 episodios del curso Laravel From Scratch 2026.

El proyecto mantiene historial de versiones con Git, documentación técnica por episodio, capturas de pantalla y una estructura organizada para facilitar su revisión.
