# Proyecto 1 - Laravel From Scratch 2026

## ISW811 Aplicaciones Web con Software Libre

**Estudiante:** Ignacio Araya  
**Curso:** ISW811 Aplicaciones Web con Software Libre  
**Proyecto:** Laravel From Scratch 2026  
**Repositorio:** https://github.com/nachoar24/Proyecto-1  

---

## Descripción del proyecto

Este proyecto corresponde al desarrollo progresivo de una aplicación web utilizando Laravel como parte del curso ISW811 Aplicaciones Web con Software Libre.

El proyecto sigue los episodios del curso Laravel From Scratch 2026 y culmina con una aplicación para registrar, organizar y administrar ideas.

Cada usuario puede crear una cuenta, iniciar sesión y gestionar únicamente sus propias ideas. Las ideas pueden incluir una descripción con Markdown, estado, imagen destacada, enlaces relacionados y pasos accionables.

El desarrollo aplica conceptos de backend, frontend, seguridad, pruebas automatizadas, almacenamiento de archivos, versionamiento y documentación técnica.

---

## Funcionalidad principal

La aplicación permite:

- Registrar usuarios.
- Iniciar y cerrar sesión.
- Proteger páginas mediante middleware.
- Crear ideas.
- Consultar una idea individual.
- Editar ideas mediante un modal.
- Eliminar ideas.
- Filtrar ideas según su estado.
- Asociar uno o varios enlaces a una idea.
- Registrar pasos accionables.
- Marcar pasos como completados o pendientes.
- Cargar imágenes destacadas.
- Actualizar el perfil del usuario.
- Cambiar el nombre, correo electrónico y contraseña.
- Notificar al correo anterior cuando se modifica la dirección de la cuenta.
- Utilizar Markdown en las descripciones.
- Aplicar autorización para proteger ideas y pasos pertenecientes a otros usuarios.
- Ejecutar pruebas automatizadas con Pest.

---

## Tecnologías utilizadas

El proyecto utiliza las siguientes tecnologías y herramientas:

- Laravel
- PHP 8.2
- Composer
- MariaDB
- Blade
- Eloquent ORM
- Vagrant
- VirtualBox
- Apache
- Node.js
- npm
- Vite
- Tailwind CSS
- DaisyUI
- AlpineJS
- Tailwind Typography
- Pest
- Laravel Pint
- Git
- GitHub

---

## Entorno de desarrollo

El proyecto fue desarrollado dentro de una máquina virtual administrada con Vagrant.

Ruta principal de la máquina virtual en el equipo local:

```text
~/ISW811/VMs/webserver
```

Ruta del proyecto Laravel en el equipo local:

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

## Requisitos para ejecutar el proyecto

Para instalar y ejecutar el proyecto se requiere:

- Git
- VirtualBox
- Vagrant
- PHP 8.2 o una versión compatible
- Composer
- Node.js
- npm
- MariaDB o un motor de base de datos compatible
- Extensiones PHP requeridas por Laravel
- Extensión GD de PHP para pruebas y manejo de imágenes
- Extensión correspondiente al motor de base de datos utilizado

En el entorno original, Apache, PHP, Composer, Node.js, npm y MariaDB se ejecutan dentro de la máquina virtual.

---

## Ingresar a la máquina virtual

Desde Git Bash:

```bash
cd ~/ISW811/VMs/webserver
vagrant ssh
```

Después, dentro de la máquina virtual:

```bash
cd ~/sites/lfs.isw811.xyz
```

---

## Instalación del proyecto

Después de clonar o descomprimir el proyecto, ingresar a su carpeta:

```bash
cd ~/sites/lfs.isw811.xyz
```

Instalar las dependencias de PHP:

```bash
composer install
```

Instalar las dependencias de JavaScript:

```bash
npm install
```

Crear el archivo de entorno a partir del ejemplo:

```bash
cp .env.example .env
```

Generar la clave de la aplicación:

```bash
php artisan key:generate
```

Configurar en `.env` la conexión a la base de datos.

Ejemplo de configuración para MariaDB:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lfs
DB_USERNAME=larauser
DB_PASSWORD=
```

La contraseña debe establecerse según la configuración local del servidor.

---

## Base de datos

La base de datos utilizada durante el desarrollo fue:

```text
lfs
```

El usuario configurado fue:

```text
larauser
```

Después de configurar `.env`, ejecutar las migraciones:

```bash
php artisan migrate
```

Para eliminar las tablas y volver a ejecutar todas las migraciones:

```bash
php artisan migrate:fresh
```

Para reconstruir la base de datos con datos generados por seeders, cuando existan:

```bash
php artisan migrate:fresh --seed
```

---

## Enlace del almacenamiento público

Las imágenes destacadas se guardan en el disco público de Laravel.

Después de instalar el proyecto, se debe crear el enlace simbólico:

```bash
php artisan storage:link
```

Este comando conecta:

```text
public/storage
```

con:

```text
storage/app/public
```

El enlace `public/storage` no debe agregarse manualmente al repositorio porque se regenera mediante Artisan.

---

## Compilar los assets

Para compilar los archivos CSS y JavaScript destinados a la ejecución normal del proyecto:

```bash
rm -f public/hot
npm run build
```

Después se recomienda limpiar las cachés:

```bash
php artisan optimize:clear
php artisan view:clear
```

La aplicación puede visitarse en:

```text
http://lfs.isw811.xyz
```

---

## Desarrollo con Vite

Durante el desarrollo también se puede ejecutar Vite en modo servidor:

```bash
npm run dev -- --host 0.0.0.0
```

Sin embargo, para las verificaciones finales del proyecto se utilizó principalmente:

```bash
npm run build
```

El archivo temporal:

```text
public/hot
```

no debe incluirse en el entregable.

---

## Secuencia recomendada después de descomprimir

Dentro de la máquina virtual:

```bash
cd ~/sites/lfs.isw811.xyz

composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
rm -f public/hot
npm run build
php artisan optimize:clear
php artisan view:clear
```

Después se puede abrir:

```text
http://lfs.isw811.xyz
```

---

## Ejecutar pruebas con Pest

Para ejecutar toda la suite:

```bash
./vendor/bin/pest
```

Para ejecutar únicamente las pruebas Feature:

```bash
./vendor/bin/pest tests/Feature
```

Para ejecutar únicamente las pruebas Unit:

```bash
./vendor/bin/pest tests/Unit
```

Para ejecutar las pruebas de ideas:

```bash
./vendor/bin/pest tests/Feature/IdeaTest.php
```

Para ejecutar las pruebas del perfil:

```bash
./vendor/bin/pest tests/Feature/ProfileTest.php
```

Para ejecutar las pruebas unitarias de Markdown:

```bash
./vendor/bin/pest tests/Unit/IdeaTest.php
```

---

## Pruebas implementadas

La suite verifica, entre otros comportamientos:

- Registro de usuarios.
- Inicio y cierre de sesión.
- Validación de credenciales.
- Protección de páginas privadas.
- Relaciones entre usuarios, ideas y pasos.
- Creación de ideas.
- Validación de títulos, estados, enlaces e imágenes.
- Carga de imágenes destacadas.
- Filtrado de ideas por estado.
- Renderizado del modal de edición.
- Actualización de ideas.
- Sincronización de pasos.
- Cambio del estado de los pasos.
- Autorización para ver ideas.
- Autorización para actualizar ideas.
- Autorización para eliminar ideas.
- Protección de pasos pertenecientes a otros usuarios.
- Actualización del perfil.
- Conservación de la contraseña cuando el campo permanece vacío.
- Validación de correo único.
- Notificación al correo anterior.
- Conversión segura de Markdown a HTML.

---

## Formatear código

El proyecto incluye Laravel Pint.

Para formatear archivos concretos:

```bash
./vendor/bin/pint app/Models/Idea.php tests/Unit/IdeaTest.php
```

También existe el script general:

```bash
composer run format
```

Se recomienda utilizar Pint únicamente sobre los archivos trabajados cuando existan cambios locales pendientes en otros archivos.

---

## Limpiar cachés de Laravel

Para limpiar las cachés principales:

```bash
php artisan optimize:clear
```

Para limpiar específicamente las vistas compiladas:

```bash
php artisan view:clear
```

Para revisar las rutas:

```bash
php artisan route:list
```

---

## Tinker

Para interactuar con los modelos desde consola:

```bash
php artisan tinker
```

Ejemplo para buscar un usuario:

```php
$user = App\Models\User::where(
    'email',
    'ignacio.araya@ejemplo.com'
)->first();
```

Ejemplo para consultar sus ideas:

```php
$user?->ideas;
```

---

## Arquitectura y organización

El proyecto utiliza distintas capas para separar responsabilidades.

### Controladores

Los controladores coordinan:

- Solicitudes HTTP.
- Autorización.
- Validación.
- Ejecución de clases de acción.
- Redirecciones.
- Mensajes de sesión.

### Form Requests

Se utilizan para validar la creación y actualización de ideas.

### Action classes

Las clases principales son:

```text
app/Actions/CreateIdea.php
app/Actions/UpdateIdea.php
```

Estas clases contienen la lógica de creación y actualización, incluyendo imágenes, enlaces y pasos accionables.

### Policies y Gates

La autorización comprueba que cada usuario pueda trabajar únicamente con sus propias ideas.

También se protege la actualización de los pasos mediante la idea a la que pertenecen.

### Modelos

Los modelos contienen:

- Relaciones.
- Casts.
- Consultas relacionadas.
- Accessors.
- Conversión de Markdown.

### Blade y AlpineJS

Blade se utiliza para renderizar vistas y componentes reutilizables.

AlpineJS administra:

- Apertura y cierre de modales.
- Estado seleccionado.
- Pasos dinámicos.
- Enlaces dinámicos.
- Formularios de creación y edición.

---

## Funcionalidades implementadas

Durante el desarrollo se implementaron:

- Rutas de Laravel.
- Vistas Blade.
- Layout principal.
- Navegación.
- Componentes Blade reutilizables.
- Formularios con CSRF.
- Validación.
- Form Request Classes.
- Migraciones.
- Modelos Eloquent.
- Relaciones entre modelos.
- Factories.
- Enums.
- Controladores.
- Autenticación.
- Middleware `auth` y `guest`.
- Gates.
- Policies.
- Notificaciones.
- Pruebas con Pest.
- Interfaz con Tailwind CSS.
- Componentes de DaisyUI.
- Interactividad con AlpineJS.
- Mensajes flash.
- Tarjetas de ideas.
- Filtros por estado.
- Conteos por estado.
- Vista individual de ideas.
- Modal para crear ideas.
- Modal para editar ideas.
- Enlaces asociados.
- Pasos accionables.
- Actualización de pasos.
- Imágenes destacadas.
- Clases de acción.
- Actualización completa de ideas.
- Edición del perfil.
- Cambio opcional de contraseña.
- Notificación al correo anterior.
- Soporte para Markdown.
- Estilos de Typography.
- Documentación de despliegue.
- Documentación y evidencias por episodio.

---

## Documentación

La documentación se encuentra en:

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

Índice del Entregable 03:

```text
docs/entregable03.md
```

Conclusiones finales:

```text
docs/conclusiones-proyecto.md
```

La documentación del proyecto final se encuentra en:

```text
docs/final-project/
```

Las capturas se encuentran en:

```text
docs/img/
```

Cada episodio cuenta con documentación, comandos, descripción de los cambios y evidencias visuales.

---

## Entregables

### Entregable 01

Incluye los episodios 1 al 16.

Contenido principal:

- Fundamentos de Laravel.
- Rutas.
- Blade.
- Formularios.
- Validación.
- Base de datos.
- Eloquent.
- CRUD inicial.
- Autenticación básica.
- Middleware.
- Relaciones entre modelos.

### Entregable 02

Incluye los episodios 17 al 29.

Contenido principal:

- Autorización con Gates.
- Autorización con Policies.
- Vite.
- Notificaciones.
- Colas.
- Pruebas con Pest.
- Inicio del proyecto final.
- Modelo de datos.
- Tailwind CSS.
- AlpineJS.
- Tarjetas de ideas.
- Filtros por estado.

### Entregable 03

Incluye los episodios 30 al 43.

Contenido principal:

- Vista individual de una idea.
- Modal funcional con AlpineJS.
- Formulario para crear ideas.
- Pruebas de creación.
- Enlaces relacionados.
- Pasos accionables.
- Cambio de estado de pasos.
- Imágenes destacadas.
- `php artisan storage:link`.
- Action classes.
- Autorización.
- Pruebas de autorización.
- Modal para editar ideas.
- Actualización completa de ideas.
- Edición del perfil.
- Notificación por cambio de correo.
- Documentación de despliegue.
- Descripciones con Markdown.
- Reflexión final y posibles mejoras.

---

## Proceso de despliegue documentado

El proyecto fue desarrollado y validado en un entorno local administrado con Vagrant.

El código se publica en GitHub mediante:

```bash
git push origin main
```

El episodio de despliegue documenta un flujo de producción basado en Laravel Forge.

Un proceso típico de despliegue incluye:

```bash
git pull origin main

composer install \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-dev

npm ci
npm run build

php artisan migrate --force
php artisan storage:link
php artisan optimize
```

Antes del despliegue deben configurarse correctamente las variables de entorno del servidor:

- `APP_ENV`
- `APP_KEY`
- `APP_URL`
- Conexión a la base de datos
- Configuración de correo
- Configuración de archivos
- Credenciales externas, cuando existan

No se debe subir el archivo `.env` al repositorio.

La documentación describe el proceso aprendido aunque el entorno principal de evaluación se ejecute mediante Vagrant y el dominio local del proyecto.

---

## Repositorio Git

El archivo del entregable debe incluir la carpeta:

```text
.git/
```

Esto permite verificar:

- Commits por episodio.
- Historial del proyecto.
- Ramas.
- Configuración del repositorio.
- Evolución del desarrollo.

No se debe excluir `.git/` al comprimir el proyecto.

---

## Archivos que no deben incluirse

El entregable no debe incluir:

```text
vendor/
node_modules/
.env
public/hot
```

`vendor/` puede reconstruirse con:

```bash
composer install
```

`node_modules/` puede reconstruirse con:

```bash
npm install
```

`.env` contiene configuración local y datos potencialmente sensibles.

`public/hot` es un archivo temporal utilizado por Vite en modo desarrollo.

---

## Generar el archivo comprimido del Entregable 03

Desde Git Bash, ingresar a la carpeta que contiene el proyecto:

```bash
cd ~/ISW811/VMs/webserver/sites
```

Ejecutar:

```bash
tar cvfz ISW811_Proyecto1_Entregable03_ArayaIgnacio.tar.gz \
  --exclude=lfs.isw811.xyz/vendor \
  --exclude=lfs.isw811.xyz/node_modules \
  --exclude=lfs.isw811.xyz/.env \
  --exclude=lfs.isw811.xyz/public/hot \
  lfs.isw811.xyz/
```

El archivo generado será:

```text
ISW811_Proyecto1_Entregable03_ArayaIgnacio.tar.gz
```

Este comando incluye el repositorio Git completo y excluye las dependencias regenerables y la configuración sensible.

---

## Verificar el contenido del archivo comprimido

Para confirmar que `.git` fue incluido:

```bash
tar tzf ISW811_Proyecto1_Entregable03_ArayaIgnacio.tar.gz \
  | grep -m 1 'lfs.isw811.xyz/.git/HEAD'
```

Para comprobar que `vendor` no fue incluido:

```bash
tar tzf ISW811_Proyecto1_Entregable03_ArayaIgnacio.tar.gz \
  | grep 'lfs.isw811.xyz/vendor/'
```

Este último comando no debe devolver resultados.

Para comprobar que `node_modules` no fue incluido:

```bash
tar tzf ISW811_Proyecto1_Entregable03_ArayaIgnacio.tar.gz \
  | grep 'lfs.isw811.xyz/node_modules/'
```

Este comando tampoco debe devolver resultados.

Para verificar la documentación:

```bash
tar tzf ISW811_Proyecto1_Entregable03_ArayaIgnacio.tar.gz \
  | grep 'docs/'
```

---

## Verificación final antes de entregar

Antes de generar el archivo comprimido se recomienda ejecutar:

```bash
cd ~/ISW811/VMs/webserver/sites/lfs.isw811.xyz
git status --short
```

El resultado ideal es que no aparezcan archivos modificados o pendientes.

Después, dentro de la máquina virtual:

```bash
cd ~/sites/lfs.isw811.xyz

rm -f public/hot
npm run build
php artisan optimize:clear
php artisan view:clear
./vendor/bin/pest
```

También se debe confirmar que exista el enlace de almacenamiento:

```bash
php artisan storage:link
```

Si el enlace ya existe, Laravel mostrará un mensaje informándolo.

---

## Consideraciones finales

El proyecto evidencia el desarrollo acumulativo del curso Laravel From Scratch 2026.

Se mantuvieron:

- Commits por episodio.
- Documentación técnica.
- Capturas de pantalla.
- Pruebas automatizadas.
- Separación de responsabilidades.
- Seguridad mediante autenticación y autorización.
- Versionamiento con Git.
- Publicación del código en GitHub.

El proyecto puede continuar ampliándose con funciones como equipos, ideas compartidas, comentarios, roles, historial de cambios, recuperación de contraseña y despliegue en un servidor de producción.