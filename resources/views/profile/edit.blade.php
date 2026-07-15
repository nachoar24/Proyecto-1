<x-layout title="Editar perfil">
    <x-forms.card
        title="Editar tu cuenta"
        description="Actualiza tu nombre, correo electrónico o contraseña."
    >
        <form
            method="POST"
            action="{{ route('profile.update') }}"
            class="space-y-5"
            data-test="edit-profile-form"
        >
            @csrf
            @method('PATCH')

            <div class="space-y-2">
                <label for="name" class="label">
                    Nombre
                </label>

                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', $user->name) }}"
                    autocomplete="name"
                    class="input w-full"
                    required
                    autofocus
                    data-test="profile-name-input"
                >

                <x-forms.error name="name" />
            </div>

            <div class="space-y-2">
                <label for="email" class="label">
                    Correo electrónico
                </label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email', $user->email) }}"
                    autocomplete="email"
                    class="input w-full"
                    required
                    data-test="profile-email-input"
                >

                <x-forms.error name="email" />
            </div>

            <div class="space-y-2">
                <label for="password" class="label">
                    Nueva contraseña
                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                    class="input w-full"
                    data-test="profile-password-input"
                >

                <p class="text-xs leading-5 text-muted">
                    Déjala vacía para conservar tu contraseña actual.
                </p>

                <x-forms.error name="password" />
            </div>

            <button
                type="submit"
                class="button mt-2 w-full"
                data-test="update-profile-button"
            >
                Actualizar cuenta
            </button>
        </form>
    </x-forms.card>
</x-layout>