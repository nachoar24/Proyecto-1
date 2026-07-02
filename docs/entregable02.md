# Proyecto 1 - Entregable 02

## ISW811 Aplicaciones Web con Software Libre

**Estudiante:** Ignacio Araya
**Curso:** ISW811 Aplicaciones Web con Software Libre
**Proyecto:** Laravel From Scratch 2026
**Entregable:** Entregable 02
**Episodios documentados:** 17 al 29
**Contenido:** Autorización avanzada, Vite, notificaciones, colas, pruebas con Pest e inicio del proyecto final

---

## Descripción general

Este documento funciona como índice principal de la documentación correspondiente al Entregable 02 del Proyecto 1.

En este entregable se continuó con los mecanismos de autenticación y autorización de Laravel, profundizando en el uso de Gates y Policies para proteger rutas, acciones sensibles y elementos visuales de la interfaz.

Además, se trabajaron herramientas más avanzadas del framework, como la configuración de assets frontend mediante Vite, el uso de notificaciones, el concepto de colas para procesos en segundo plano y la configuración de pruebas automatizadas con Pest.

Finalmente, se inició el desarrollo del proyecto final del curso, aplicando de forma integrada los conocimientos adquiridos en los episodios previos. Esta primera parte del proyecto final incluye la configuración inicial de la aplicación, el diseño del modelo de datos, la construcción de una interfaz con TailwindCSS, pruebas para autenticación, mensajes interactivos con AlpineJS, tarjetas de ideas y filtros por estado.

---

## Repositorio del proyecto

Repositorio en GitHub:

https://github.com/nachoar24/Proyecto-1

---

## Estructura de documentación

La documentación se encuentra organizada por episodio dentro de la carpeta `docs/`.

Los episodios 17 y 18 corresponden a la segunda parte del módulo **Authentication / Authorization**.

Los episodios 19 al 22 corresponden al módulo **Digging Deeper**.

Los episodios 23 al 29 corresponden a la primera parte del módulo **Final Project: Build and Deploy an App**.

---

# II. Authentication / Authorization

## Episodio 17: Authorization Using Gates

[Ver documentación del episodio 17](authentication-authorization/17-authorization-using-gates.md)

En este episodio se implementó autorización mediante Gates. Se definieron reglas de autorización para controlar qué usuarios pueden acceder a ciertas secciones o ejecutar acciones específicas dentro de la aplicación.

También se utilizaron directivas Blade relacionadas con autorización para mostrar u ocultar contenido de acuerdo con los permisos del usuario autenticado.

---

## Episodio 18: Authorization Using Policies

[Ver documentación del episodio 18](authentication-authorization/18-authorization-using-policies.md)

En este episodio se implementó autorización mediante Policies. Se creó una política asociada al modelo correspondiente para centralizar las reglas de autorización y mantener el código más organizado.

Las acciones sensibles quedaron protegidas mediante métodos de autorización, permitiendo validar si un usuario puede ver, actualizar o eliminar recursos específicos.

---

# III. Digging Deeper

## Episodio 19: Frontend Asset Bundling with Vite

[Ver documentación del episodio 19](digging-deeper/19-frontend-asset-bundling-with-vite.md)

En este episodio se configuró Vite para la compilación local de recursos frontend.

Se trabajó con los archivos CSS y JavaScript del proyecto, permitiendo que Laravel cargue los assets compilados desde las vistas Blade. También se verificó el funcionamiento de Vite durante el desarrollo local.

---

## Episodio 20: Notifications

[Ver documentación del episodio 20](digging-deeper/20-notifications.md)

En este episodio se implementó el uso de notificaciones en Laravel.

Se creó una notificación de prueba y se revisó cómo Laravel permite enviar mensajes mediante distintos canales. La evidencia se documentó localmente dentro del proyecto, sin depender de servicios externos de pago.

---

## Episodio 21: When to Queue it Up

[Ver documentación del episodio 21](digging-deeper/21-when-to-queue-it-up.md)

En este episodio se estudió el uso de colas para ejecutar procesos en segundo plano.

Se documentó cuándo conviene mover una tarea a una cola, especialmente cuando se trata de procesos que no deben retrasar la respuesta principal de la aplicación, como notificaciones, correos o tareas pesadas.

---

## Episodio 22: How to Get Started Testing Your Code

[Ver documentación del episodio 22](digging-deeper/22-how-to-get-started-testing-your-code.md)

En este episodio se configuraron y ejecutaron pruebas automatizadas con Pest.

Se realizaron pruebas Feature para validar funcionalidades principales del proyecto. Debido al entorno utilizado con PHP 8.2, algunas pruebas se adaptaron para mantener compatibilidad con las versiones disponibles, conservando el objetivo de validar el comportamiento de la aplicación.

---

# IV. Final Project: Build and Deploy an App

## Episodio 23: Final Project Setup

[Ver documentación del episodio 23](final-project/23-final-project-setup.md)

En este episodio se inició formalmente el proyecto final.

Se revisó la configuración base de la aplicación, se validó que el proyecto ejecutara correctamente y se preparó la estructura necesaria para continuar con los siguientes episodios del módulo final.

---

## Episodio 24: Design Your Model Layer

[Ver documentación del episodio 24](final-project/24-design-your-model-layer.md)

En este episodio se diseñó la capa de modelos del proyecto final.

Se trabajó con migraciones, modelos, factories y enums para representar la estructura principal de datos de la aplicación. También se definieron entidades relacionadas con ideas, pasos y estados.

---

## Episodio 25: Tailwind Theme Setup And Initial UI

[Ver documentación del episodio 25](final-project/25-tailwind-theme-setup-and-initial-ui.md)

En este episodio se configuró la interfaz inicial del proyecto final utilizando TailwindCSS.

Se definieron estilos base, componentes reutilizables y una estructura visual inicial para las pantallas principales de autenticación y navegación de la aplicación.

---

## Episodio 26: Browser Testing Registration Forms With Pest

[Ver documentación del episodio 26](final-project/26-browser-testing-registration-forms-with-pest.md)

En este episodio se trabajaron pruebas para los formularios de autenticación.

Se validaron los flujos de registro, inicio de sesión y cierre de sesión mediante Pest. Debido al entorno disponible, las pruebas se implementaron como pruebas Feature, manteniendo el objetivo del episodio de validar el comportamiento de los formularios de autenticación.

---

## Episodio 27: Flash Messaging and Interactivity with AlpineJS

[Ver documentación del episodio 27](final-project/27-flash-messaging-and-interactivity-with-alpinejs.md)

En este episodio se incorporó AlpineJS para agregar interactividad básica a la aplicación.

Se implementaron mensajes flash dinámicos que aparecen después de acciones como registro, inicio de sesión o cierre de sesión, mejorando la retroalimentación visual para el usuario.

---

## Episodio 28: Idea Cards

[Ver documentación del episodio 28](final-project/28-idea-cards.md)

En este episodio se implementó la visualización de ideas mediante tarjetas.

Cada idea se muestra como una card con información relevante, incluyendo título, descripción, estado y fecha de creación relativa. También se utilizaron componentes Blade reutilizables para mantener una estructura más limpia y ordenada.

---

## Episodio 29: Idea Filtering

[Ver documentación del episodio 29](final-project/29-idea-filtering.md)

En este episodio se implementaron filtros por estado para las ideas.

La pantalla principal permite filtrar ideas por todas, pendientes, en progreso o completadas. También se agregaron conteos por estado y validación para ignorar filtros inválidos recibidos mediante la URL.

---

# Resumen de funcionalidades implementadas

Durante el Entregable 02 se implementaron las siguientes funcionalidades:

* Implementación de autorización mediante Gates.
* Implementación de autorización mediante Policies.
* Protección de rutas y acciones sensibles.
* Uso de directivas Blade relacionadas con autorización.
* Configuración de assets frontend mediante Vite.
* Compilación local de recursos CSS y JavaScript.
* Implementación de notificaciones.
* Uso básico de colas para procesamiento en segundo plano.
* Configuración y ejecución de pruebas con Pest.
* Inicio del proyecto final.
* Diseño del modelo de datos del proyecto final.
* Uso de migraciones, modelos, factories y enums.
* Construcción de una interfaz inicial con TailwindCSS.
* Uso de componentes Blade reutilizables.
* Implementación de pruebas para registro, login y logout.
* Uso de AlpineJS para interactividad básica.
* Implementación de mensajes flash dinámicos.
* Implementación de tarjetas de ideas.
* Implementación de filtros de ideas por estado.
* Validación de filtros inválidos en la URL.
* Conteo de ideas por estado.

---

# Evidencias

Las capturas de pantalla se encuentran almacenadas en la carpeta:

```text
docs/img/
```

Cada archivo de documentación por episodio incluye sus respectivas evidencias mediante imágenes en formato Markdown.

Las evidencias cubren:

* Reglas de autorización funcionando.
* Uso de Gates.
* Uso de Policies.
* Assets compilados con Vite.
* Notificaciones o correos de prueba.
* Cola configurada o documentada.
* Pruebas ejecutadas correctamente.
* Configuración inicial del proyecto final.
* Diseño del modelo de datos.
* Interfaz inicial del proyecto final.
* Formularios de autenticación.
* Pruebas de registro, login y logout.
* Mensajes flash con AlpineJS.
* Tarjetas de ideas.
* Filtros de ideas por estado.

---

# Observación sobre servicios externos

Algunos episodios del curso pueden mencionar servicios externos, cuentas en la nube, Laravel Forge u otras herramientas que requieren registro, pago o infraestructura adicional.

Para este entregable no se contrataron servicios externos ni se utilizó infraestructura de pago.

Cuando algún episodio dependía de un servicio externo o de una herramienta adicional, se documentó el procedimiento observado en el curso y se sustituyó la evidencia por documentación técnica del proceso, pruebas locales o ejecución dentro del entorno de desarrollo.

---

# Instrucciones de ejecución

Las instrucciones para instalar y ejecutar el proyecto localmente se encuentran en el archivo principal:

[Ver README del proyecto](../README.md)

De forma general, para ingresar a la máquina virtual se utiliza:

```bash
cd ~/ISW811/VMs/webserver
vagrant ssh
```

Dentro de la máquina virtual, para ingresar al proyecto:

```bash
cd ~/sites/lfs.isw811.xyz
```

Para levantar Vite durante el desarrollo:

```bash
npm run dev -- --host 0.0.0.0
```

Para ejecutar las pruebas automatizadas:

```bash
./vendor/bin/pest
```

Para limpiar caché de Laravel:

```bash
php artisan optimize:clear
php artisan view:clear
```

---

# Control de versiones

Se realizó al menos un commit por episodio, desde el episodio 17 hasta el episodio 29.

Cada commit documenta el avance correspondiente a un episodio específico del curso.

El proyecto debe incluir el repositorio Git completo, incluyendo la carpeta `.git/`, para que pueda revisarse el historial de versiones.

---

# Consideraciones técnicas

El proyecto utiliza Laravel, Blade, Eloquent ORM, MariaDB, Vite, TailwindCSS, AlpineJS, Pest, migraciones, modelos, factories, enums, Gates, Policies, notificaciones y colas.

El archivo `.tar.gz` del entregable debe incluir el proyecto completo y el repositorio Git con la carpeta `.git/`.

No se deben incluir los directorios:

```text
vendor/
node_modules/
```

Tampoco se debe incluir el archivo `.env`, ya que puede contener información sensible.

---

# Comando sugerido para generar el archivo comprimido

Desde la carpeta que contiene el proyecto, se puede generar el archivo `.tar.gz` excluyendo `vendor`, `node_modules` y `.env`.

```bash
tar cvfz ISW811_Proyecto1_Entregable02_ArayaIgnacio.tar.gz \
  --exclude=lfs.isw811.xyz/vendor \
  --exclude=lfs.isw811.xyz/node_modules \
  --exclude=lfs.isw811.xyz/.env \
  lfs.isw811.xyz/
```

---

# Forma de entrega

El entregable final debe subirse al Campus Virtual de la UTN como un único archivo comprimido en formato `.tar.gz`, antes de la fecha límite establecida.

Nombre sugerido del archivo:

```text
ISW811_Proyecto1_Entregable02_ArayaIgnacio.tar.gz
```

---

# Comentarios finales

Este entregable evidencia el avance acumulativo de los episodios 17 al 29 del curso Laravel From Scratch 2026.

El proyecto mantiene historial de versiones con Git, documentación técnica por episodio, capturas de pantalla y una estructura organizada para facilitar su revisión.

Además, este avance deja preparada la base del proyecto final, incorporando autorización, pruebas, componentes reutilizables, estilos con TailwindCSS, interactividad con AlpineJS, tarjetas de ideas y filtros por estado.
