<x-layout title="Detalle de idea">
    <section class="rounded-md bg-gray-800 p-6">
        <h1 class="text-2xl font-bold mb-4">Detalle de la idea</h1>

        <p class="text-lg">
            {{ $idea->description }}
        </p>

        <p class="mt-3 text-sm text-gray-400">
            Estado: {{ $idea->state }}
        </p>

        <div class="mt-6 flex gap-4">
            <a href="/ideas" class="text-blue-300 hover:underline">
                Volver a ideas
            </a>

            <a href="/ideas/{{ $idea->id }}/edit" class="text-yellow-300 hover:underline">
                Editar
            </a>
        </div>
    </section>
</x-layout>