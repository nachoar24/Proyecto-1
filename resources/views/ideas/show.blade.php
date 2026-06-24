<x-layout title="Detalle de idea">
    <section class="card bg-base-200 shadow-xl">
        <div class="card-body">
            <h1 class="card-title text-2xl">Detalle de la idea</h1>

            <p class="mt-4 text-lg">
                {{ $idea->description }}
            </p>

            <div class="mt-3">
                <span class="badge badge-outline badge-info">
                    Estado: {{ $idea->state }}
                </span>
            </div>

            <div class="card-actions mt-6">
                <a href="/ideas/{{ $idea->id }}/edit" class="btn btn-primary">
                    Editar
                </a>

                <a href="/ideas" class="btn btn-ghost">
                    Volver a ideas
                </a>
            </div>
        </div>
    </section>
</x-layout>