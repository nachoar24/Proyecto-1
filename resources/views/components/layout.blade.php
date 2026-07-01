<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-background text-foreground">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Ideas' }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-screen bg-background text-foreground antialiased">
        <x-layout.nav />

        <main class="mx-auto max-w-5xl px-4 py-10">
            {{ $slot }}
        </main>
    </body>
</html>