@props(['title' => 'Laravel From Scratch'])

<!DOCTYPE html>
<html lang="es" data-theme="dracula">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <!--<link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>-->

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-base-100 text-base-content">
    <div class="mx-auto max-w-5xl p-6">
        <x-nav />

        <main class="mt-8">
            {{ $slot }}
        </main>
    </div>
</body>
</html>