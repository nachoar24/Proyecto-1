<x-layout title="Registro">
    <section class="card mx-auto max-w-xl bg-base-200 shadow-xl">
        <div class="card-body">
            <h1 class="card-title text-2xl">Crear cuenta</h1>

            <form method="POST" action="/register" class="mt-4 space-y-4">
                @csrf

                <div>
                    <label for="name" class="label">
                        <span class="label-text">Nombre</span>
                    </label>

                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name') }}"
                        required
                        class="input input-bordered w-full @error('name') input-error @enderror"
                        placeholder="Tu nombre"
                    >

                    <x-forms.error name="name" />
                </div>

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
                        placeholder="Mínimo 8 caracteres"
                    >

                    <x-forms.error name="password" />
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="btn btn-primary">
                        Registrarse
                    </button>

                    <a href="/login" class="btn btn-ghost">
                        Ya tengo cuenta
                    </a>
                </div>
            </form>
        </div>
    </section>
</x-layout>