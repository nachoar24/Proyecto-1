<x-layout title="Ideas">
    <section>
        <div class="mb-6 flex items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold">Tus ideas</h1>

                <p class="mt-2 text-sm opacity-80">
                    Guarda, revisa y administra tus ideas desde este espacio.
                </p>
            </div>

            <a href="/ideas/create" class="btn btn-primary">
                Crear nueva idea
            </a>
        </div>

        @if ($ideas->count() > 0)
            <div class="grid gap-4 md:grid-cols-2">
                @foreach ($ideas as $idea)
                    <x-idea-card href="/ideas/{{ $idea->id }}">
                        <div class="flex flex-col gap-3">
                            <p>
                                {{ $idea->description }}
                            </p>

                            <div>
                                <span class="badge badge-outline badge-info">
                                    {{ $idea->state }}
                                </span>
                            </div>
                        </div>
                    </x-idea-card>
                @endforeach
            </div>
        @else
            <div class="card bg-base-200 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">No hay ideas registradas todavía</h2>

                    <p>
                        Crea tu primera idea para comenzar a utilizar el cuaderno digital.
                    </p>

                    <div class="card-actions justify-end">
                        <a href="/ideas/create" class="btn btn-primary">
                            Crear la primera idea
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </section>
</x-layout>