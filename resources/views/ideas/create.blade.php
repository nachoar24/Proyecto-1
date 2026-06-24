<x-layout title="Crear idea">
    <section>
        <h1 class="text-2xl font-bold mb-4">Crear nueva idea</h1>

        <form method="POST" action="/ideas" class="space-y-4">
            @csrf

            <div>
                <label for="description" class="block text-sm font-medium mb-2">
                    Descripción
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900"
                    placeholder="Escribe una idea que quieras guardar para después"
                ></textarea>
            </div>

            <button
                type="submit"
                class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
            >
                Guardar
            </button>
        </form>

        <p class="mt-6">
            <a href="/ideas" class="text-blue-300 hover:underline">
                Volver al listado de ideas
            </a>
        </p>
    </section>
</x-layout>