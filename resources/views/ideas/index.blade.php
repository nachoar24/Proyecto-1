<x-layout title="Mis ideas">
    <div class="space-y-10">
        <header class="mx-auto max-w-2xl text-center">
            <h1 class="text-4xl font-bold tracking-tight text-foreground">
                Mis ideas
            </h1>

            <p class="mt-3 text-sm text-muted">
                Organiza, revisa y da seguimiento a tus ideas.
            </p>
        </header>

        <div class="flex flex-wrap items-center justify-center gap-3">
            <a
                href="{{ route('ideas.index') }}"
                class="button {{ $currentStatus ? 'button-outline' : '' }}"
            >
                Todas
                <span class="pl-1 text-xs">
                    {{ $statusCounts->get('all', 0) }}
                </span>
            </a>

            @foreach ($statuses as $status)
                <a
                    href="{{ route('ideas.index', ['status' => $status->value]) }}"
                    class="button {{ $currentStatus === $status->value ? '' : 'button-outline' }}"
                >
                    {{ $status->label() }}

                    <span class="pl-1 text-xs">
                        {{ $statusCounts->get($status->value, 0) }}
                    </span>
                </a>
            @endforeach
        </div>

        @if ($ideas->isEmpty())
            <x-card class="mx-auto max-w-xl text-center">
                <h2 class="text-lg font-semibold text-foreground">
                    @if ($currentStatus)
                        No hay ideas para este filtro
                    @else
                        Aún no tienes ideas
                    @endif
                </h2>

                <p class="mt-2 text-muted">
                    @if ($currentStatus)
                        Prueba seleccionando otro estado o revisa todas tus ideas.
                    @else
                        Cuando registres una idea, aparecerá en esta sección.
                    @endif
                </p>

                @if ($currentStatus)
                    <a href="{{ route('ideas.index') }}" class="button mt-6">
                        Ver todas
                    </a>
                @else
                    <a href="/ideas/create" class="button mt-6">
                        Crear idea
                    </a>
                @endif
            </x-card>
        @else
            <div class="grid gap-6 md:grid-cols-2">
                @foreach ($ideas as $idea)
                    @php
                        $usesLegacyDescriptionAsTitle = $idea->title === 'Untitled idea' && filled($idea->description);

                        $title = $usesLegacyDescriptionAsTitle
                            ? $idea->description
                            : $idea->title;

                        $description = $usesLegacyDescriptionAsTitle
                            ? null
                            : $idea->description;
                    @endphp

                    <x-card href="{{ route('ideas.show', $idea) }}" class="min-h-40">
                        <div class="flex h-full flex-col justify-between gap-6">
                            <div class="space-y-4">
                                <div class="flex items-start justify-between gap-4">
                                    <h2 class="max-w-[75%] text-lg font-semibold leading-snug text-foreground">
                                        {{ $title }}
                                    </h2>

                                    <x-idea.status-label :status="$idea->status" />
                                </div>

                                @if ($description)
                                    <p class="text-sm leading-6 text-muted">
                                        {{ $description }}
                                    </p>
                                @endif
                            </div>

                            <p class="text-xs text-muted">
                                Creada {{ $idea->created_at->locale('es')->diffForHumans() }}
                            </p>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>