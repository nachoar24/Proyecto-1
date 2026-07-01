<nav class="border-b border-border">
    <div class="mx-auto flex h-16 max-w-5xl items-center justify-between px-4">
        <a href="/" class="text-lg font-bold tracking-tight text-foreground">
            Ideas
        </a>

        <div class="flex items-center gap-5">
            @auth
                <a href="/ideas" class="text-sm text-muted hover:text-foreground">
                    Mis ideas
                </a>

                <form method="POST" action="/logout">
                    @csrf

                    <button type="submit" class="button button-outline">
                        Cerrar sesión
                    </button>
                </form>
            @else
                <a href="/login" class="text-sm text-muted hover:text-foreground">
                    Iniciar sesión
                </a>

                <a href="/register" class="button">
                    Crear cuenta
                </a>
            @endauth
        </div>
    </div>
</nav>