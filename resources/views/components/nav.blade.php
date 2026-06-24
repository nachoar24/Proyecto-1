<div class="navbar rounded-box bg-base-200">
    <div class="navbar-start">
        <a href="/ideas" class="btn btn-ghost text-xl">
            Idea
        </a>
    </div>

    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal gap-1 px-1">
            <li>
                <a href="/ideas">Inicio</a>
            </li>

            @auth
                <li>
                    <a href="/ideas/create">Nueva idea</a>
                </li>
            @endauth

            <li>
                <a href="/about">Acerca de</a>
            </li>

            <li>
                <a href="/contact">Contacto</a>
            </li>
        </ul>
    </div>

    <div class="navbar-end gap-2">
        @guest
            <a href="/login" class="btn btn-ghost">
                Iniciar sesión
            </a>

            <a href="/register" class="btn btn-primary">
                Registrarse
            </a>
        @endguest

        @auth
            <span class="hidden text-sm opacity-80 md:inline">
                Hola, {{ auth()->user()->name }}
            </span>

            <form method="POST" action="/logout">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-ghost">
                    Cerrar sesión
                </button>
            </form>
        @endauth
    </div>
</div>