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

        @if ($ideas->isEmpty())
            <x-card class="mx-auto max-w-xl text-center">
                <h2 class="text-lg font-semibold text-foreground">
                    Aún no tienes ideas
                </h2>

                <p class="mt-2 text-muted">
                    Cuando registres una idea, aparecerá en esta sección.
                </p>

                <a href="/ideas/create" class="button mt-6">
                    Crear idea
                </a>
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