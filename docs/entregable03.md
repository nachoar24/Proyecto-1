# Proyecto 1 - Entregable 03

## ISW811 Aplicaciones Web con Software Libre

**Estudiante:** Ignacio Araya  
**Curso:** ISW811 Aplicaciones Web con Software Libre  
**Proyecto:** Laravel From Scratch 2026  
**Entregable:** Entregable 03  
**Episodios documentados:** 30 al 43  
**Contenido:** Desarrollo final de la aplicación de ideas, modales con AlpineJS, pruebas, enlaces, pasos accionables, imágenes, clases de acción, autorización, edición de perfil, despliegue y mejora final con Markdown

---

## Descripción general

Este documento funciona como índice principal de la documentación correspondiente al Entregable 03 del Proyecto 1.

En este entregable se completó el módulo **Final Project: Build and Deploy an App**, continuando el desarrollo de la aplicación de administración de ideas iniciado en el Entregable 02.

Durante los episodios 30 al 43 se implementaron las funciones principales del sistema, incluyendo la vista individual de ideas, formularios dentro de modales, creación y edición de registros, enlaces asociados, pasos accionables, carga de imágenes, clases de acción, autorización, actualización de ideas, edición del perfil y soporte para Markdown.

También se ampliaron las pruebas automatizadas para comprobar la creación de ideas, la carga de imágenes, la actualización de registros, la autorización y la edición del perfil.

Finalmente, se documentó el proceso de despliegue presentado en el curso, se implementó una solicitud de mejora y se realizó una reflexión sobre posibles funciones futuras para continuar desarrollando la aplicación.

---

## Repositorio del proyecto

Repositorio en GitHub:

https://github.com/nachoar24/Proyecto-1

---

## Estructura de documentación

La documentación se encuentra organizada por episodio dentro de la carpeta:

```text
docs/final-project/
```

Los episodios 30 al 43 corresponden a la segunda y última parte del módulo:

```text
Final Project: Build and Deploy an App
```

Las capturas de pantalla utilizadas como evidencia se encuentran en:

```text
docs/img/
```

Las conclusiones generales del proyecto se encuentran en:

[Ver conclusiones del proyecto](conclusiones-proyecto.md)

---

# IV. Final Project: Build and Deploy an App

## Episodio 30: Show A Single Idea

[Ver documentación del episodio 30](final-project/30-show-a-single-idea.md)

En este episodio se implementó la página individual de una idea.

Se agregó una ruta para consultar una idea específica y una vista que muestra su título, descripción, estado, fecha de actualización, enlaces relacionados y pasos accionables.

Esta página se convirtió en el punto principal desde el cual posteriormente se agregaron las funciones de edición y eliminación.

---

## Episodio 31: Create A Functional Modal With AlpineJS

[Ver documentación del episodio 31](final-project/31-create-a-functional-modal-with-alpinejs.md)

En este episodio se construyó un modal funcional utilizando AlpineJS.

Se implementaron eventos para abrir y cerrar el modal desde diferentes elementos de la interfaz.

También se agregó soporte para cerrar el modal mediante:

- Botón de cierre.
- Botón de cancelar.
- Tecla Escape.
- Clic fuera del contenido principal.

El componente fue preparado para reutilizarse en formularios posteriores.

---

## Episodio 32: Construct The Idea Form

[Ver documentación del episodio 32](final-project/32-construct-the-idea-form.md)

En este episodio se construyó el formulario principal para registrar ideas.

El formulario incluye campos para:

- Título.
- Descripción.
- Estado.
- Imagen destacada.
- Pasos accionables.
- Enlaces relacionados.

AlpineJS se utilizó para manejar dinámicamente los estados, enlaces y pasos antes de enviar el formulario al servidor.

---

## Episodio 33: Test The Create Idea Form

[Ver documentación del episodio 33](final-project/33-test-the-create-idea-form.md)

En este episodio se implementaron pruebas automatizadas para la creación de ideas.

Las pruebas comprobaron:

- Creación de una idea.
- Asociación con el usuario autenticado.
- Persistencia del título.
- Persistencia de la descripción.
- Persistencia del estado.
- Validación de campos obligatorios.
- Redirección después de crear.
- Mensaje de confirmación.

Estas pruebas permitieron asegurar el funcionamiento del formulario de creación.

---

## Episodio 34: Allow For One or Many Links

[Ver documentación del episodio 34](final-project/34-allow-for-one-or-many-links.md)

En este episodio se agregó la posibilidad de asociar uno o varios enlaces a una idea.

El formulario permite agregar enlaces dinámicamente utilizando AlpineJS.

Los enlaces son enviados como un arreglo, validados como direcciones URL y almacenados mediante un cast del modelo.

También se implementó su visualización en la página individual de la idea.

---

## Episodio 35: Actionable Steps

[Ver documentación del episodio 35](final-project/35-actionable-steps.md)

En este episodio se implementaron pasos accionables asociados a las ideas.

Cada paso contiene:

- Una descripción.
- Un estado de completado.

Los pasos se registran durante la creación de una idea y se muestran en la página individual.

También se agregó la capacidad de alternar cada paso entre pendiente y completado.

---

## Episodio 36: Upload Featured Images To Storage

[Ver documentación del episodio 36](final-project/36-upload-featured-images-to-storage.md)

En este episodio se implementó la carga de imágenes destacadas.

Las imágenes son:

- Validadas como archivos de imagen.
- Almacenadas en el disco público de Laravel.
- Asociadas con la idea mediante `image_path`.
- Mostradas en las tarjetas.
- Mostradas en la página individual.

También se utilizó:

```bash
php artisan storage:link
```

para conectar:

```text
public/storage
```

con:

```text
storage/app/public
```

Las pruebas utilizan `Storage::fake()` para verificar la carga sin almacenar archivos reales durante la ejecución automatizada.

---

## Episodio 37: Action Classes

[Ver documentación del episodio 37](final-project/37-action-classes.md)

En este episodio se refactorizó la lógica de creación de ideas hacia una clase de acción.

Se creó:

```text
app/Actions/CreateIdea.php
```

La clase se encarga de:

- Crear la idea.
- Asociarla con el usuario autenticado.
- Guardar la imagen.
- Registrar enlaces.
- Crear los pasos accionables.
- Ejecutar el proceso dentro de una transacción.

Esta refactorización permitió reducir la cantidad de lógica dentro del controlador.

---

## Episodio 38: Authorization Is A Requirement

[Ver documentación del episodio 38](final-project/38-authorization-is-a-requirement.md)

En este episodio se aplicó autorización a las acciones principales del sistema.

Se creó o actualizó una policy para verificar que un usuario solamente pueda trabajar con sus propias ideas.

La autorización fue aplicada a:

- Visualización.
- Edición.
- Actualización.
- Eliminación.
- Actualización de pasos.

También se agregaron pruebas para comprobar que un usuario no pueda acceder o modificar recursos pertenecientes a otra persona.

---

## Episodio 39: The Edit Idea Modal

[Ver documentación del episodio 39](final-project/39-the-edit-idea-modal.md)

En este episodio se implementó el modal para editar ideas.

El formulario de creación fue extraído a un componente reutilizable capaz de funcionar en dos modos:

- Creación.
- Edición.

Cuando el componente recibe una idea existente, carga automáticamente:

- Título.
- Descripción.
- Estado.
- Enlaces.
- Pasos.
- Imagen actual.

También cambia dinámicamente la ruta, el método HTTP, el título del modal y el texto del botón.

---

## Episodio 40: Update Idea Action

[Ver documentación del episodio 40](final-project/40-update-idea-action.md)

En este episodio se implementó la actualización completa de ideas mediante una clase de acción.

Se creó:

```text
app/Actions/UpdateIdea.php
```

La acción se encarga de:

- Actualizar el título.
- Actualizar la descripción.
- Cambiar el estado.
- Actualizar enlaces.
- Reemplazar la imagen cuando se selecciona otra.
- Sincronizar los pasos accionables.
- Mantener el estado completado de cada paso.
- Ejecutar la operación dentro de una transacción.

También se agregaron pruebas para verificar la actualización y la autorización.

---

## Episodio 41: Edit Your Profile

[Ver documentación del episodio 41](final-project/41-edit-your-profile.md)

En este episodio se implementó la edición del perfil del usuario.

Se agregó una página protegida desde la cual se puede modificar:

- Nombre.
- Correo electrónico.
- Contraseña.

La contraseña es opcional. Si el campo permanece vacío, se conserva la contraseña actual.

También se agregó una notificación dirigida al correo anterior cuando el usuario modifica su dirección de correo electrónico.

Las pruebas comprueban autenticación, actualización, correo único, contraseña opcional y envío de la notificación.

---

## Episodio 42: Deploy And Then Implement A Feature Request

[Ver documentación del episodio 42](final-project/42-deploy-and-implement-feature-request.md)

En este episodio se revisó la suite completa de pruebas y se documentó el proceso de despliegue presentado en el curso.

También se implementó una solicitud de mejora para permitir Markdown en las descripciones de las ideas.

Se creó un accessor que utiliza:

```php
Str::markdown()
```

El contenido puede incluir:

- Encabezados.
- Negrita.
- Enlaces.
- Listas.
- Párrafos.

También se instaló el plugin:

```text
@tailwindcss/typography
```

para aplicar estilos visuales al contenido generado.

Se agregaron pruebas unitarias para comprobar la conversión y la eliminación de HTML inseguro.

---

## Episodio 43: Where To Go From Here

[Ver documentación del episodio 43](final-project/43-where-to-go-from-here.md)

Este episodio representa el cierre del curso y del proyecto final.

No se implementó una funcionalidad nueva.

Se realizó una revisión general de la aplicación, se ejecutaron las pruebas finales, se compilaron los assets y se documentaron posibles caminos para continuar desarrollando el sistema.

Entre las mejoras propuestas se encuentran:

- Equipos.
- Ideas compartidas.
- Roles y permisos.
- Comentarios.
- Historial de cambios.
- Recuperación de contraseña.
- Verificación de correo.
- Administración avanzada de imágenes.
- Búsqueda.
- Paginación.
- Laravel Livewire.
- Inertia.js.
- Vue.
- React.
- Despliegue en producción.

---

# Resumen de funcionalidades implementadas

Durante el Entregable 03 se implementaron las siguientes funcionalidades:

- Página para mostrar una idea individual.
- Formularios para crear ideas.
- Formularios para editar ideas.
- Modal funcional con AlpineJS.
- Componente modal reutilizable.
- Formulario dinámico para ideas.
- Pruebas automatizadas de creación.
- Asociación de uno o varios enlaces.
- Validación de enlaces.
- Registro de pasos accionables.
- Actualización del estado de pasos.
- Visualización de pasos completados y pendientes.
- Carga de imágenes destacadas.
- Validación de imágenes.
- Almacenamiento público con Laravel.
- Uso de `php artisan storage:link`.
- Refactorización hacia `CreateIdea`.
- Refactorización hacia `UpdateIdea`.
- Transacciones de base de datos.
- Autorización mediante policy.
- Protección para visualizar ideas.
- Protección para actualizar ideas.
- Protección para eliminar ideas.
- Protección para modificar pasos.
- Pruebas relacionadas con autorización.
- Modal para editar ideas.
- Precarga de los valores existentes.
- Actualización de título.
- Actualización de descripción.
- Actualización de estado.
- Actualización de enlaces.
- Actualización de pasos.
- Actualización de imagen destacada.
- Edición de perfil.
- Actualización opcional de contraseña.
- Validación de correo único.
- Notificación al correo anterior.
- Soporte para Markdown.
- Tailwind Typography.
- Pruebas Unit y Feature.
- Documentación del proceso de despliegue.
- Reflexión final del proyecto.

---

# Requisitos del Entregable 03

El proyecto demuestra como mínimo:

- Vista individual de una idea.
- Modal de creación.
- Modal de edición.
- Formulario funcional.
- Enlaces asociados.
- Pasos accionables.
- Cambio del estado de los pasos.
- Carga de imágenes.
- Almacenamiento público.
- Action classes.
- Autorización.
- Pruebas de autorización.
- Edición de perfil.
- Documentación del despliegue.
- Implementación de la mejora final.
- Reflexión sobre futuras funciones.

---

# Evidencias

Las capturas se encuentran almacenadas en:

```text
docs/img/
```

Cada archivo de documentación por episodio incluye las imágenes correspondientes.

Las evidencias del Entregable 03 cubren:

- Vista individual de una idea.
- Botones de edición y eliminación.
- Modal de creación.
- Modal de edición.
- Formulario para crear ideas.
- Formulario para editar ideas.
- Enlaces relacionados.
- Pasos accionables.
- Estado completado de los pasos.
- Carga de imagen destacada.
- Imagen mostrada en las tarjetas.
- Imagen mostrada en la página individual.
- Código de las clases de acción.
- Código de autorización.
- Pruebas de autorización.
- Actualización de una idea.
- Formulario de perfil.
- Perfil actualizado.
- Descripción con Markdown.
- Suite completa de pruebas.
- Resultado final de la aplicación.
- Historial final de Git.

Entre las evidencias principales se encuentran:

```text
docs/img/30-show-idea-browser.png
docs/img/31-functional-modal-open.png
docs/img/32-idea-form-browser.png
docs/img/35-actionable-steps-show.png
docs/img/36-featured-image-index.png
docs/img/38-authorization-tests-passing.png
docs/img/39-edit-idea-modal.png
docs/img/40-updated-idea-browser.png
docs/img/41-edit-profile-form.png
docs/img/42-markdown-description-browser.png
docs/img/43-final-application.png
docs/img/43-final-test-suite.png
```

---

# Pruebas automatizadas

Las pruebas se ejecutan mediante Pest.

Para ejecutar toda la suite:

```bash
./vendor/bin/pest
```

Para ejecutar únicamente las pruebas Feature:

```bash
./vendor/bin/pest tests/Feature
```

Para ejecutar las pruebas de ideas:

```bash
./vendor/bin/pest tests/Feature/IdeaTest.php
```

Para ejecutar las pruebas del perfil:

```bash
./vendor/bin/pest tests/Feature/ProfileTest.php
```

Para ejecutar las pruebas unitarias del accessor de Markdown:

```bash
./vendor/bin/pest tests/Unit/IdeaTest.php
```

Las pruebas verifican:

- Autenticación.
- Creación de ideas.
- Validación.
- Carga de imágenes.
- Enlaces.
- Pasos accionables.
- Cambio de estado de los pasos.
- Renderizado del modal de edición.
- Actualización de ideas.
- Autorización.
- Edición del perfil.
- Cambio de contraseña.
- Validación de correo único.
- Notificaciones.
- Conversión de Markdown.

---

# Almacenamiento de imágenes

Las imágenes destacadas se almacenan en:

```text
storage/app/public/ideas
```

Para permitir su acceso desde el navegador se utiliza:

```bash
php artisan storage:link
```

Este comando crea el enlace:

```text
public/storage
```

El enlace simbólico no se incluye manualmente en el repositorio.

Las imágenes cargadas durante la ejecución local tampoco forman parte obligatoria del repositorio, ya que corresponden a datos generados por los usuarios.

---

# Documentación del despliegue

El episodio 42 documenta el proceso de despliegue presentado en el curso.

El flujo general incluye:

1. Ejecutar las pruebas localmente.
2. Crear un commit.
3. Hacer push hacia GitHub.
4. Actualizar el servidor.
5. Instalar dependencias.
6. Compilar assets.
7. Ejecutar migraciones.
8. Limpiar u optimizar cachés.
9. Verificar la aplicación.

Un ejemplo de script de despliegue es:

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

El entorno principal utilizado para la evaluación se ejecuta localmente mediante Vagrant.

El proyecto fue publicado en GitHub mediante:

```bash
git push origin main
```

No se contrataron servicios externos ni infraestructura de pago para la entrega universitaria.

---

# Observación sobre Laravel Forge y servicios externos

En el curso se presenta Laravel Forge como herramienta de despliegue.

Para este proyecto se documentó el procedimiento aprendido, pero la ejecución principal se realizó en el entorno local configurado con:

- Vagrant.
- VirtualBox.
- Apache.
- PHP.
- MariaDB.
- Dominio local.

Cuando una función dependía de un servicio externo, se utilizó documentación técnica, pruebas locales o herramientas de Laravel que no requerían contratar infraestructura adicional.

---

# Instrucciones de ejecución

Las instrucciones completas de instalación, ejecución, pruebas y despliegue se encuentran en:

[Ver README del proyecto](../README.md)

De forma general, para ingresar a la máquina virtual:

```bash
cd ~/ISW811/VMs/webserver
vagrant ssh
```

Dentro de la máquina virtual:

```bash
cd ~/sites/lfs.isw811.xyz
```

Instalar dependencias:

```bash
composer install
npm install
```

Configurar el entorno:

```bash
cp .env.example .env
php artisan key:generate
```

Ejecutar migraciones:

```bash
php artisan migrate
```

Crear el enlace de almacenamiento:

```bash
php artisan storage:link
```

Compilar assets:

```bash
rm -f public/hot
npm run build
```

Limpiar cachés:

```bash
php artisan optimize:clear
php artisan view:clear
```

Ejecutar pruebas:

```bash
./vendor/bin/pest
```

La aplicación puede visitarse en:

```text
http://lfs.isw811.xyz
```

---

# Control de versiones

Se realizó al menos un commit por episodio, desde el episodio 30 hasta el episodio 43.

Los commits principales incluyen:

```text
30 Show A Single Idea
31 Create A Functional Modal With AlpineJS
32 Construct The Idea Form
33 Test The Create Idea Form
34 Allow For One or Many Links
35 Actionable Steps
36 Upload Featured Images To Storage
37 Action Classes
38 Authorization Is A Requirement
39 The Edit Idea Modal
40 Update Idea Action
41 Edit Your Profile
42 Deploy And Then Implement A Feature Request
43 Where To Go From Here
```

El repositorio Git completo debe incluirse en el entregable.

La carpeta:

```text
.git/
```

no debe excluirse al crear el archivo comprimido.

---

# Archivo de conclusiones

Las conclusiones finales se encuentran en:

[Ver conclusiones del proyecto](conclusiones-proyecto.md)

Este archivo contiene:

- Principales aprendizajes.
- Dificultades encontradas.
- Soluciones aplicadas.
- Funcionalidades más relevantes.
- Posibles mejoras futuras.
- Reflexión final.

---

# Consideraciones técnicas

El proyecto utiliza:

- Laravel.
- PHP.
- Composer.
- MariaDB.
- Blade.
- Eloquent ORM.
- Vite.
- Tailwind CSS.
- DaisyUI.
- Tailwind Typography.
- AlpineJS.
- Pest.
- Laravel Pint.
- Vagrant.
- VirtualBox.
- Apache.
- Git.
- GitHub.

El archivo `.tar.gz` debe incluir el proyecto completo y la carpeta `.git/`.

No deben incluirse:

```text
vendor/
node_modules/
.env
public/hot
```

Estas dependencias y archivos pueden reconstruirse o corresponden a configuración sensible y temporal.

---

# Comando sugerido para generar el archivo comprimido

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

Este comando incluye:

- Código fuente.
- Documentación.
- Capturas.
- Historial de Git.
- Carpeta `.git/`.

Y excluye:

- `vendor/`
- `node_modules/`
- `.env`
- `public/hot`

---

# Verificación del archivo comprimido

Para confirmar que `.git` está incluido:

```bash
tar tzf ISW811_Proyecto1_Entregable03_ArayaIgnacio.tar.gz \
  | grep -m 1 'lfs.isw811.xyz/.git/HEAD'
```

Para confirmar que `vendor` no está incluido:

```bash
tar tzf ISW811_Proyecto1_Entregable03_ArayaIgnacio.tar.gz \
  | grep 'lfs.isw811.xyz/vendor/'
```

No debe mostrar resultados.

Para confirmar que `node_modules` no está incluido:

```bash
tar tzf ISW811_Proyecto1_Entregable03_ArayaIgnacio.tar.gz \
  | grep 'lfs.isw811.xyz/node_modules/'
```

Tampoco debe mostrar resultados.

Para verificar la documentación:

```bash
tar tzf ISW811_Proyecto1_Entregable03_ArayaIgnacio.tar.gz \
  | grep 'docs/'
```

---

# Forma de entrega

El Entregable 03 debe subirse al Campus Virtual de la UTN como un único archivo comprimido en formato:

```text
.tar.gz
```

Nombre sugerido:

```text
ISW811_Proyecto1_Entregable03_ArayaIgnacio.tar.gz
```

Antes de comprimir se recomienda confirmar:

```bash
git status --short
```

El resultado ideal es que el repositorio no tenga archivos pendientes.

También se recomienda ejecutar:

```bash
./vendor/bin/pest
```

para confirmar que toda la suite continúe funcionando.

---

# Comentarios finales

Este entregable evidencia la finalización de los episodios 30 al 43 del curso Laravel From Scratch 2026.

Durante esta etapa se completó la aplicación final de administración de ideas, integrando funcionalidades de creación, edición, eliminación, enlaces, pasos accionables, imágenes, autorización, edición del perfil y Markdown.

El proyecto mantiene:

- Historial de versiones.
- Commits por episodio.
- Documentación técnica.
- Capturas de evidencia.
- Pruebas automatizadas.
- Separación de responsabilidades.
- Seguridad mediante autenticación y autorización.
- Instrucciones finales de instalación y ejecución.

El Entregable 03 representa el cierre del proyecto y deja una base preparada para continuar incorporando funciones más avanzadas en el futuro.