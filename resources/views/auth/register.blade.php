<x-layout title="Registrarse">
    <x-forms.card
        title="Crear una cuenta"
        description="Comienza a organizar tus ideas hoy."
    >
        <form method="POST" action="/register" class="space-y-4">
            @csrf

            <x-forms.field
                label="Nombre"
                name="name"
                autocomplete="name"
                required
            />

            <x-forms.field
                label="Correo electrónico"
                name="email"
                type="email"
                autocomplete="email"
                required
            />

            <x-forms.field
                label="Contraseña"
                name="password"
                type="password"
                autocomplete="new-password"
                required
            />

            <button type="submit" class="button mt-2 w-full">
                Crear cuenta
            </button>
        </form>
    </x-forms.card>
</x-layout>