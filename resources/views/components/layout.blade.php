@props(['title' => 'Laravel From Scratch'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 40px auto;
            line-height: 1.6;
        }

        nav {
            margin-bottom: 24px;
        }

        nav a {
            color: blue;
            margin-right: 12px;
            text-decoration: none;
        }

        .card {
            background: #e5e5e5;
            padding: 24px;
            text-align: center;
            border-radius: 8px;
        }

        .max-w-400 {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <nav>
        <a href="/">Inicio</a>
        <a href="/about">Acerca de</a>
        <a href="/contact">Contacto</a>
    </nav>

    <main>
        {{ $slot }}
    </main>
</body>
</html>