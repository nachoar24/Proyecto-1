<x-layout title="Iniciar sesión">
    <x-forms.card
        title="Iniciar sesión"
        description="Bienvenido de vuelta."
    >
        <form method="POST" action="/login" class="space-y-4">
            @csrf

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
                autocomplete="current-password"
                required
            />

            <button type="submit" class="button mt-2 w-full" data-test="login-button">
                Iniciar sesión
            </button>
        </form>
    </x-forms.card>
</x-layout>