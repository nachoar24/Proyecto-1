[<- Regresar](/docs/entregable01.md)

# Módulo 1

## Routing 101

Para crear rutas en Laravel, se utiliza el archivo `routes/web.php`. Aquí es donde se definen las rutas para la aplicación web. Cada ruta está asociada a una función o a un controlador que maneja la lógica de la solicitud.

Por ejemplo, para crear una ruta que responda a la URL `/` y devuelva un mensaje de bienvenida, se puede agregar el siguiente código en `routes/web.php`:

```
phpRoute::get(`/`, function (){
    return '¡Bienvenido a Laravel!';
});
```

Modificamos el archivo "Welcome" por un html básico.

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Bienvenido</h1>
    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos sint ipsa placeat quibusdam cum, corrupti, iste itaque, vitae enim eaque possimus laboriosam expedita debitis ducimus culpa dolores voluptatibus. Incidunt, voluptas?
    </p>
    <a href="/about">Acerca de nosotros</a>
</body>
</html>
```