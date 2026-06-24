<x-layout title="Editar idea">
    <section>
        <h1 class="text-2xl font-bold mb-4">Editar idea</h1>

        <form method="POST" action="/ideas/{{ $idea->id }}" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label for="description" class="block text-sm font-medium mb-2">
                    Descripción
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900"
                >{{ $idea->description }}</textarea>
            </div>

            <button
                type="submit"
                class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
            >
                Actualizar
            </button>
        </form>

        <form method="POST" action="/ideas/{{ $idea->id }}" class="mt-4">
            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="rounded-md bg-red-600 px-4 py-2 text-white hover:bg-red-700"
            >
                Eliminar
            </button>
        </form>

        <p class="mt-6">
            <a href="/ideas/{{ $idea->id }}" class="text-blue-300 hover:underline">
                Cancelar y volver al detalle
            </a>
        </p>
    </section>
</x-layout>