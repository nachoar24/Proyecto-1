[<- Regresar al README](../README.md)

# Conclusiones del proyecto

## Proyecto 1 - Laravel From Scratch 2026

**Estudiante:** Ignacio Araya  
**Curso:** ISW811 Aplicaciones Web con Software Libre  

---

## Introducción

El desarrollo de este proyecto permitió aplicar de manera progresiva los principales conceptos necesarios para construir una aplicación web con Laravel.

El proyecto comenzó con ejercicios básicos de rutas, vistas y formularios, y posteriormente evolucionó hasta convertirse en una aplicación completa para registrar y administrar ideas.

La aplicación final incluye autenticación, autorización, relaciones entre modelos, formularios dinámicos, almacenamiento de imágenes, pruebas automatizadas, edición de perfiles, notificaciones y soporte para Markdown.

Además del desarrollo técnico, el proyecto requirió mantener documentación por episodio, capturas de pantalla y un historial organizado de commits.

---

## Principales aprendizajes

### Estructura de una aplicación Laravel

Uno de los principales aprendizajes fue comprender la organización general de Laravel y la responsabilidad de sus diferentes partes.

Durante el proyecto se trabajó con:

- Rutas.
- Controladores.
- Modelos.
- Migraciones.
- Factories.
- Form Requests.
- Policies.
- Gates.
- Notifications.
- Action classes.
- Vistas Blade.
- Componentes.
- Pruebas Unit y Feature.

Esta separación permitió evitar que toda la lógica se concentrara en un solo archivo.

---

### Rutas y controladores

Se aprendió a definir rutas para diferentes métodos HTTP:

- `GET`
- `POST`
- `PATCH`
- `DELETE`

También se aplicaron rutas nombradas, lo que permitió evitar direcciones escritas manualmente en distintas partes de la aplicación.

Los controladores se utilizaron para coordinar solicitudes, autorización, validación, ejecución de acciones y redirecciones.

---

### Blade y componentes reutilizables

Blade permitió crear una interfaz organizada y reutilizable.

Se desarrollaron componentes para:

- Layout.
- Navegación.
- Tarjetas.
- Formularios.
- Campos.
- Errores.
- Modales.
- Etiquetas de estado.
- Iconos.
- Mensajes flash.

El uso de componentes redujo la duplicación de código y permitió mantener una apariencia consistente.

---

### Base de datos y Eloquent

El proyecto permitió trabajar con:

- Migraciones.
- Modelos.
- Relaciones.
- Factories.
- Casts.
- Enums.
- Accessors.
- Consultas mediante Eloquent.

Se implementaron relaciones entre:

- Usuarios e ideas.
- Ideas y pasos accionables.

También se utilizaron casts para manejar enlaces como arreglos y estados como enums.

---

### Autenticación y autorización

Uno de los aprendizajes más importantes fue la diferencia entre autenticación y autorización.

La autenticación permite identificar al usuario.

La autorización determina si el usuario puede realizar una acción sobre un recurso.

Se utilizaron:

- Middleware `auth`.
- Middleware `guest`.
- Gates.
- Policies.
- `Gate::authorize()`.

Gracias a estas herramientas, un usuario no puede ver, actualizar o eliminar ideas pertenecientes a otra persona.

También se protegieron los pasos accionables mediante la idea asociada.

---

### Validación

Se aplicó validación para:

- Títulos.
- Descripciones.
- Estados.
- Enlaces.
- Imágenes.
- Pasos accionables.
- Nombres.
- Correos electrónicos.
- Contraseñas.

Se utilizaron Form Requests para las ideas y validación desde el controlador para el perfil.

También se agregaron mensajes personalizados en español.

---

### AlpineJS

AlpineJS se utilizó para agregar interactividad sin crear una aplicación de una sola página.

Se implementó:

- Apertura y cierre de modales.
- Selección de estados.
- Adición dinámica de enlaces.
- Eliminación de enlaces.
- Adición de pasos.
- Eliminación de pasos.
- Preparación dinámica de los campos enviados al servidor.

Uno de los mayores aprendizajes fue cómo sincronizar estructuras JavaScript con los datos esperados por Laravel.

---

### Carga de imágenes

Se aprendió a validar y almacenar imágenes utilizando el sistema de archivos de Laravel.

Las imágenes se guardaron en:

```text
storage/app/public
```

Para permitir su acceso desde el navegador se utilizó:

```bash
php artisan storage:link
```

También se comprobó la existencia de los archivos mediante pruebas automatizadas y `Storage::fake()`.

---

### Clases de acción

La creación y actualización de ideas fueron trasladadas a clases específicas:

```text
CreateIdea
UpdateIdea
```

Esto permitió reducir la cantidad de lógica dentro del controlador.

Cada clase quedó responsable de una operación concreta.

`CreateIdea` crea la idea y sus relaciones.

`UpdateIdea` actualiza la idea, procesa la imagen y sincroniza los pasos accionables.

---

### Pruebas automatizadas

Las pruebas con Pest fueron fundamentales para comprobar el comportamiento del proyecto.

Las pruebas Feature verificaron:

- Autenticación.
- Creación de ideas.
- Validación.
- Actualización.
- Eliminación.
- Imágenes.
- Enlaces.
- Pasos.
- Autorización.
- Perfil.
- Notificaciones.

Las pruebas Unit verificaron el accessor utilizado para convertir Markdown en HTML.

La suite permitió realizar cambios con mayor seguridad y detectar errores antes de crear los commits.

---

### Git y documentación

El proyecto también permitió practicar:

- Commits.
- Push hacia GitHub.
- Revisión del staging.
- Historial por episodio.
- Exclusión de archivos.
- Documentación técnica.
- Capturas de evidencia.

Se realizó al menos un commit por episodio del curso.

También se mantuvo documentación dentro de la carpeta:

```text
docs/
```

---

## Dificultades encontradas

### Reutilización del modal

Inicialmente, el formulario para crear ideas estaba escrito directamente dentro de la vista principal.

Esto impedía utilizar el mismo formulario desde la página individual.

La dificultad consistió en extraer el formulario a un componente reutilizable sin perder las funciones existentes.

---

### Sincronización de pasos accionables

Al principio, los pasos se enviaban como una lista de textos.

Durante la edición fue necesario conservar también el estado `completed`.

Esto requirió cambiar la estructura a objetos con:

```text
description
completed
```

También fue necesario adaptar:

- El componente AlpineJS.
- La validación.
- La creación de ideas.
- La actualización.
- Las pruebas.

---

### Actualización de relaciones

Durante la actualización de una idea podían agregarse, modificarse o eliminarse pasos.

Para simplificar el proceso, el formulario se utilizó como fuente de verdad.

La solución fue eliminar los pasos anteriores y reconstruirlos con los datos recibidos.

Aunque esta estrategia cambia los identificadores de los pasos, permitió mantener una implementación clara y funcional.

---

### Declaraciones duplicadas de clases

Durante la creación de las clases de acción se presentó un error porque los nombres de las clases quedaron intercambiados entre archivos.

PHP mostró errores como:

```text
Cannot declare class App\Actions\UpdateIdea
```

y advertencias relacionadas con PSR-4.

El problema se solucionó verificando que cada archivo declarara la clase correspondiente:

```text
app/Actions/CreateIdea.php -> class CreateIdea
app/Actions/UpdateIdea.php -> class UpdateIdea
```

Después se regeneró el autoload con:

```bash
composer dump-autoload
```

---

### Mayúsculas y minúsculas en namespaces

Durante la implementación de la notificación del perfil se presentó el error:

```text
Class "app\Notifications\EmailChanged" not found
```

La carpeta física se llama:

```text
app/
```

pero el namespace de Laravel es:

```php
App\
```

El error se solucionó utilizando:

```php
use App\Notifications\EmailChanged;
```

Este problema permitió comprender mejor la relación PSR-4 entre namespaces y rutas físicas, especialmente en Linux.

---

### Pruebas Unit con factories

Las pruebas ubicadas inicialmente en:

```text
tests/Unit/IdeaTest.php
```

utilizaban factories y base de datos.

Esto produjo:

```text
A facade root has not been set.
```

La solución fue mantener esas comprobaciones en las pruebas Feature y dejar en Unit únicamente pruebas que crean objetos en memoria sin depender del entorno completo de Laravel.

---

### Manejo de archivos pendientes en Git

Durante diferentes episodios quedaron archivos modificados de capítulos anteriores.

Esto requirió evitar comandos como:

```bash
git add .
```

La solución fue agregar únicamente los archivos relacionados con cada capítulo y verificar el staging mediante:

```bash
git diff --cached --name-status
```

Esto ayudó a mantener commits más organizados.

---

### Compilación de assets

También fue necesario comprender la diferencia entre:

```bash
npm run dev
```

y:

```bash
npm run build
```

Para las verificaciones finales se decidió utilizar `npm run build`, eliminar `public/hot` y limpiar las cachés de Laravel.

Esto permitió probar la aplicación con los assets compilados.

---

## Soluciones aplicadas

Las principales soluciones fueron:

- Extraer formularios a componentes Blade reutilizables.
- Utilizar AlpineJS para los modales y campos dinámicos.
- Aplicar Form Requests.
- Crear `CreateIdea` y `UpdateIdea`.
- Utilizar transacciones de base de datos.
- Proteger acciones mediante una policy.
- Autorizar pasos a través de la idea relacionada.
- Validar imágenes y enlaces.
- Utilizar `Storage::fake()` en pruebas.
- Mantener la contraseña actual cuando el campo queda vacío.
- Enviar notificaciones bajo demanda al correo anterior.
- Convertir Markdown mediante un accessor.
- Eliminar HTML manual potencialmente inseguro.
- Separar pruebas Unit y Feature correctamente.
- Ejecutar Pest antes de realizar commits.
- Revisar el staging antes de cada commit.
- Mantener documentación y evidencias por episodio.

---

## Funcionalidades más relevantes

### Gestión completa de ideas

La función principal permite:

- Crear.
- Consultar.
- Editar.
- Actualizar.
- Eliminar.
- Filtrar.

Cada idea puede contener información adicional y está asociada con su propietario.

---

### Modal reutilizable

El mismo componente puede funcionar para crear o editar una idea.

El componente cambia dinámicamente:

- Nombre del modal.
- Título.
- Acción.
- Método HTTP.
- Texto del botón.
- Valores iniciales.

---

### Pasos accionables

Los pasos permiten convertir una idea en una lista de acciones concretas.

Cada paso puede alternar entre:

```text
Pendiente
Completado
```

También pueden agregarse o eliminarse durante la edición.

---

### Autorización

La autorización es una de las funciones más importantes porque protege los datos de cada usuario.

Las pruebas demuestran que un usuario no puede:

- Ver ideas ajenas.
- Actualizar ideas ajenas.
- Eliminar ideas ajenas.
- Modificar pasos ajenos.

---

### Imágenes destacadas

Las imágenes mejoran la presentación visual de las ideas.

El proyecto incluye:

- Validación.
- Almacenamiento.
- Vista previa.
- Renderizado en las tarjetas.
- Renderizado en la página individual.
- Pruebas de existencia del archivo.

---

### Edición de perfil

El usuario puede modificar:

- Nombre.
- Correo.
- Contraseña.

La contraseña es opcional y el correo anterior recibe una notificación cuando la dirección cambia.

---

### Markdown

El soporte para Markdown permite escribir descripciones más estructuradas.

Se pueden utilizar:

- Encabezados.
- Negrita.
- Enlaces.
- Listas.
- Párrafos.

La conversión se realiza de forma controlada para reducir riesgos relacionados con HTML inseguro.

---

## Posibles mejoras futuras

### Equipos y colaboración

Se podría permitir que varios usuarios formen parte de un equipo y trabajen sobre ideas compartidas.

Cada miembro podría tener permisos diferentes.

---

### Roles y permisos avanzados

Se podrían implementar roles como:

- Administrador.
- Propietario.
- Editor.
- Colaborador.
- Lector.

Esto permitiría crear reglas de autorización más detalladas.

---

### Comentarios

Cada idea podría incluir comentarios para facilitar la colaboración.

Los usuarios podrían recibir notificaciones cuando alguien agregue una respuesta.

---

### Historial de cambios

Se podría registrar:

- Quién modificó una idea.
- Qué campos cambiaron.
- Cuándo se realizó el cambio.
- Pasos agregados o eliminados.
- Cambios de estado.

---

### Recuperación y verificación de correo

La aplicación podría incorporar:

- Recuperación de contraseña.
- Verificación del correo.
- Confirmación de contraseña antes de cambiar credenciales.
- Cierre de otras sesiones activas.

---

### Administración de imágenes

Se podría mejorar el manejo de imágenes mediante:

- Eliminación del archivo anterior.
- Compresión.
- Redimensionamiento.
- Miniaturas.
- Validación de dimensiones.
- Almacenamiento externo.

---

### Búsqueda y paginación

Se podría agregar:

- Búsqueda por título.
- Búsqueda por descripción.
- Filtros por fechas.
- Ordenamiento.
- Etiquetas.
- Categorías.
- Paginación.

---

### Laravel Livewire

Livewire podría utilizarse para implementar interfaces dinámicas principalmente con PHP.

Podría reemplazar o complementar algunas funciones actuales de AlpineJS.

---

### Inertia.js, Vue o React

Para una interfaz más avanzada podría estudiarse:

- Inertia.js.
- Vue.
- React.

Estas tecnologías permitirían crear experiencias similares a una SPA manteniendo las rutas, controladores y autorización de Laravel.

---

### Despliegue en producción

Como siguiente paso podría configurarse un servidor real mediante:

- Laravel Forge.
- Laravel Cloud.
- VPS.
- Docker.
- Otro servicio compatible con PHP.

También podrían agregarse:

- HTTPS.
- Backups.
- Monitoreo.
- Logs.
- Colas.
- Cron.
- Optimización de producción.

---

## Reflexión final

El proyecto permitió integrar conocimientos que inicialmente se estudiaron por separado.

Al finalizar, fue posible comprender cómo se relacionan:

- Rutas.
- Controladores.
- Modelos.
- Vistas.
- Formularios.
- Validación.
- Autenticación.
- Autorización.
- JavaScript.
- Almacenamiento.
- Pruebas.
- Git.
- Despliegue.
- Documentación.

Uno de los aprendizajes principales fue que desarrollar una aplicación no consiste únicamente en hacer que una página funcione.

También es necesario considerar:

- Seguridad.
- Mantenimiento.
- Organización.
- Experiencia del usuario.
- Validación.
- Pruebas.
- Manejo de errores.
- Versionamiento.
- Documentación.

La aplicación final representa una base sólida para continuar estudiando Laravel y desarrollar proyectos más complejos.

---

## Conclusión

El proyecto Laravel From Scratch 2026 fue completado con una aplicación funcional para administrar ideas.

El sistema incluye autenticación, autorización, relaciones, imágenes, enlaces, pasos accionables, edición de perfil, notificaciones, Markdown y pruebas automatizadas.

Las dificultades encontradas permitieron aplicar soluciones reales y comprender mejor el funcionamiento interno de Laravel.

El proyecto cumple el objetivo de demostrar el aprendizaje progresivo del curso y deja una estructura preparada para incorporar nuevas funciones en el futuro.