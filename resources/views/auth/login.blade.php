<x-layout title="Iniciar sesión">
    <section class="card mx-auto max-w-xl bg-base-200 shadow-xl">
        <div class="card-body">
            <h1 class="card-title text-2xl">Iniciar sesión</h1>

            <form method="POST" action="/login" class="mt-4 space-y-4">
                @csrf

                <div>
                    <label for="email" class="label">
                        <span class="label-text">Correo electrónico</span>
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        class="input input-bordered w-full @error('email') input-error @enderror"
                        placeholder="correo@ejemplo.com"
                    >

                    <x-forms.error name="email" />
                </div>

                <div>
                    <label for="password" class="label">
                        <span class="label-text">Contraseña</span>
                    </label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        class="input input-bordered w-full @error('password') input-error @enderror"
                        placeholder="Tu contraseña"
                    >

                    <x-forms.error name="password" />
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="btn btn-primary">
                        Iniciar sesión
                    </button>

                    <a href="/register" class="btn btn-ghost">
                        Crear cuenta
                    </a>
                </div>
            </form>
        </div>
    </section>
</x-layout>