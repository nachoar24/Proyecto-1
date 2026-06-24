<x-layout title="Editar idea">
    <section class="card bg-base-200 shadow-xl">
        <div class="card-body">
            <h1 class="card-title text-2xl">Editar idea</h1>

            <form method="POST" action="/ideas/{{ $idea->id }}" class="mt-4 space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label for="description" class="label">
                        <span class="label-text">Descripción</span>
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        class="textarea textarea-bordered w-full @error('description') textarea-error @enderror"
                    >{{ old('description', $idea->description) }}</textarea>

                    <x-forms.error name="description" />
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="btn btn-primary">
                        Actualizar
                    </button>

                    <a href="/ideas/{{ $idea->id }}" class="btn btn-ghost">
                        Cancelar
                    </a>
                </div>
            </form>

            <div class="divider"></div>

            <form method="POST" action="/ideas/{{ $idea->id }}">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-error">
                    Eliminar idea
                </button>
            </form>
        </div>
    </section>
</x-layout>