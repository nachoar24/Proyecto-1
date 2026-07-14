<x-layout :title="$idea->title">
    <div class="mx-auto max-w-3xl space-y-8">
        <div class="flex items-center justify-between gap-4">
            <a
                href="{{ route('ideas.index') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-muted hover:text-foreground"
            >
                <x-icons.arrow-left />
                Volver a ideas
            </a>

            <div class="flex items-center gap-3">
                <a href="#" class="button button-outline inline-flex items-center gap-2">
                    Editar idea
                    <x-icons.external-link />
                </a>

                <form method="POST" action="{{ route('ideas.destroy', $idea) }}">
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="button button-outline text-red-400 hover:text-red-300"
                        onclick="return confirm('¿Deseas eliminar esta idea?')"
                    >
                        Eliminar
                    </button>
                </form>
            </div>
        </div>

        <section class="space-y-4">
            <h1 class="text-4xl font-bold tracking-tight text-foreground">
                {{ $idea->title }}
            </h1>

            <div class="flex flex-wrap items-center gap-3">
                <x-idea.status-label :status="$idea->status" />

                <span class="text-xs text-muted">
                    Actualizada {{ $idea->updated_at->locale('es')->diffForHumans() }}
                </span>
            </div>
        </section>

        @if ($idea->description)
            <x-card>
                <div class="max-w-none text-sm leading-7 text-muted">
                    {{ $idea->description }}
                </div>
            </x-card>
        @endif

        @if ($idea->steps->isNotEmpty())
            <section class="space-y-3">
                <h2 class="text-lg font-semibold text-foreground">
                    Pasos accionables
                </h2>

                <div class="space-y-2">
                    @foreach ($idea->steps as $step)
                        <x-card>
                            <form
                                method="POST"
                                action="{{ route('steps.update', $step) }}"
                                class="flex items-center gap-3"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    role="checkbox"
                                    aria-checked="{{ $step->completed ? 'true' : 'false' }}"
                                    class="flex size-7 shrink-0 items-center justify-center rounded-full border border-primary text-sm font-bold transition {{ $step->completed ? 'bg-primary text-primary-foreground' : 'text-transparent' }}"
                                >
                                    ✓
                                </button>

                                <span class="text-sm leading-6 {{ $step->completed ? 'text-muted line-through' : 'text-foreground' }}">
                                    {{ $step->description }}
                                </span>
                            </form>
                        </x-card>
                    @endforeach
                </div>
            </section>
        @endif

        @if (filled($idea->links))
            <section class="space-y-3">
                <h2 class="text-lg font-semibold text-foreground">
                    Enlaces relacionados
                </h2>

                <div class="space-y-2">
                    @foreach ($idea->links as $link)
                        <x-card
                            href="{{ $link }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex items-center justify-between gap-4 font-semibold text-primary"
                        >
                            <span class="truncate">
                                {{ $link }}
                            </span>

                            <x-icons.external-link class="shrink-0" />
                        </x-card>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-layout>