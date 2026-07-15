<nav class="border-b border-border bg-background/80 backdrop-blur">
    <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-6">
        <a
            href="{{ route('ideas.index') }}"
            class="text-lg font-bold tracking-tight text-foreground"
        >
            Ideas
        </a>

        <div class="flex items-center gap-5">
            @auth
                <span class="hidden text-sm text-muted sm:inline">
                    {{ auth()->user()->name }}
                </span>

                <a
                    href="{{ route('ideas.index') }}"
                    class="text-sm text-muted hover:text-foreground"
                >
                    Mis ideas
                </a>

                <a
                    href="{{ route('profile.edit') }}"
                    class="text-sm text-muted hover:text-foreground"
                    data-test="edit-profile-link"
                >
                    Editar perfil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="button button-outline"
                        data-test="logout-button"
                    >
                        Cerrar sesión
                    </button>
                </form>
            @else
                <a
                    href="{{ route('login') }}"
                    class="text-sm text-muted hover:text-foreground"
                >
                    Iniciar sesión
                </a>

                <a href="{{ route('register') }}" class="button">
                    Registrarse
                </a>
            @endauth
        </div>
    </div>
</nav>