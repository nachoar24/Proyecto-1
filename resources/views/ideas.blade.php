<x-layout title="Ideas">
    <section>
        <h1 class="text-2xl font-bold mb-4">Nueva idea</h1>

        <form method="POST" action="/ideas" class="space-y-4">
            @csrf

            <div>
                <label for="idea" class="block text-sm font-medium mb-2">
                    Idea
                </label>

                <textarea
                    id="idea"
                    name="idea"
                    rows="4"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900"
                    placeholder="Escribe una idea que quieras guardar para después"
                ></textarea>

                <p class="mt-2 text-sm text-gray-300">
                    ¿Tienes una idea que quieras guardar para más tarde?
                </p>
            </div>

            <button
                type="submit"
                class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
            >
                Guardar
            </button>
        </form>
    </section>

    <section class="mt-8">
        <div class="mb-4 flex gap-4 text-sm">
            <a href="/" class="text-blue-300 hover:underline">Todas</a>
            <a href="/?state=pending" class="text-blue-300 hover:underline">Pendientes</a>
            <a href="/?state=completed" class="text-blue-300 hover:underline">Completadas</a>
        </div>

        @if ($ideas->count() > 0)
            <h2 class="text-xl font-bold mb-3">Tus ideas</h2>

            <ul class="space-y-2">
                @foreach ($ideas as $idea)
                    <li class="rounded-md bg-gray-800 p-3 text-sm">
                        <p>{{ $idea->description }}</p>

                        <p class="mt-1 text-xs text-gray-400">
                            Estado: {{ $idea->state }}
                        </p>
                    </li>
                @endforeach
            </ul>

            <p class="mt-4">
                <a href="/delete-ideas" class="text-red-300 hover:underline">
                    Eliminar ideas temporalmente
                </a>
            </p>
        @else
            <p class="mt-6 text-sm text-gray-300">
                No hay ideas registradas por el momento.
            </p>
        @endif
    </section>
</x-layout>