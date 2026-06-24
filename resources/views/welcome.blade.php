<x-layout title="Inicio">
    <h1>{{ $saludo }}, {{ $persona }}</h1>

    <p>
        Este sitio forma parte del Proyecto 1 del curso ISW811 Aplicaciones Web con Software Libre.
        Su objetivo es evidenciar el avance práctico del curso Laravel From Scratch 2026,
        aplicando rutas, vistas, componentes Blade, formularios, base de datos, autenticación
        y buenas prácticas de desarrollo web con Laravel.
    </p>

    <p>
        En este episodio se demuestra cómo enviar datos desde una ruta hacia una vista.
        También se utiliza un parámetro de consulta en la URL para personalizar el saludo.
    </p>

    <p>
        Prueba agregando <strong>?persona=Ignacio</strong> al final de la URL principal.
    </p>
</x-layout>