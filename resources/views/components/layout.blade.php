@props(['title' => 'Laravel From Scratch'])

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-700 text-white">
    <header class="mx-auto max-w-2xl p-6">
        <nav class="flex gap-4">
            <a href="/ideas" class="text-blue-300 hover:underline">Inicio</a>
            <a href="/about" class="text-blue-300 hover:underline">Acerca de</a>
            <a href="/contact" class="text-blue-300 hover:underline">Contacto</a>
        </nav>
    </header>

    <main class="mx-auto max-w-2xl p-6">
        {{ $slot }}
    </main>
</body>
</html>