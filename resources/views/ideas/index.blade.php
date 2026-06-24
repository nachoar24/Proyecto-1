<x-layout title="Ideas">
    <section>
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold">Tus ideas</h1>

            <a
                href="/ideas/create"
                class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
            >
                Crear nueva idea
            </a>
        </div>

        @if ($ideas->count() > 0)
            <ul class="space-y-2">
                @foreach ($ideas as $idea)
                    <li class="rounded-md bg-gray-800 p-3 text-sm">
                        <a href="/ideas/{{ $idea->id }}" class="text-blue-300 hover:underline">
                            {{ $idea->description }}
                        </a>

                        <p class="mt-1 text-xs text-gray-400">
                            Estado: {{ $idea->state }}
                        </p>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="rounded-md bg-gray-800 p-6 text-sm">
                <p class="mb-4">
                    No hay ideas registradas todavía.
                </p>

                <a href="/ideas/create" class="text-blue-300 underline">
                    Crear la primera idea
                </a>
            </div>
        @endif
    </section>
</x-layout>