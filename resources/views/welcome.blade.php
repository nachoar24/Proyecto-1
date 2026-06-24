<x-layout title="Inicio">
    <h1>{{ $saludo }}, {{ $persona }}</h1>

    <p>
        Este sitio forma parte del Proyecto 1 del curso ISW811 Aplicaciones Web con Software Libre.
        Su objetivo es evidenciar el avance práctico del curso Laravel From Scratch 2026,
        aplicando rutas, vistas, componentes Blade, formularios, base de datos, autenticación
        y buenas prácticas de desarrollo web con Laravel.
    </p>

    <p>
        En este episodio se demuestra cómo enviar un arreglo desde una ruta hacia una vista
        y cómo recorrerlo utilizando directivas Blade.
    </p>

    <section>
        <h2>Tareas del proyecto</h2>

        @if (count($tareas) > 0)
            <p>Actualmente hay {{ count($tareas) }} tareas registradas:</p>
        @endif

        <ul>
            @forelse ($tareas as $tarea)
                <li>{{ $tarea }}</li>
            @empty
                <li>No hay tareas activas por el momento.</li>
            @endforelse
        </ul>
    </section>

    <p>
        Prueba agregando <strong>?persona=Ignacio</strong> al final de la URL principal
        para personalizar el saludo.
    </p>
</x-layout>