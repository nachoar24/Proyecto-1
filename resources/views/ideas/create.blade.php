<x-layout title="Crear idea">
    <section class="card bg-base-200 shadow-xl">
        <div class="card-body">
            <h1 class="card-title text-2xl">Crear nueva idea</h1>

            <form method="POST" action="/ideas" class="mt-4 space-y-4">
                @csrf

                <div>
                    <label for="description" class="label">
                        <span class="label-text">Descripción</span>
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        class="textarea textarea-bordered w-full @error('description') textarea-error @enderror"
                        placeholder="Escribe una idea que quieras guardar para después"
                    >{{ old('description') }}</textarea>

                    <x-forms.error name="description" />
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>

                    <a href="/ideas" class="btn btn-ghost">
                        Volver al listado
                    </a>
                </div>
            </form>
        </div>
    </section>
</x-layout>