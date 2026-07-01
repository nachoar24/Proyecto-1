@props([
    'title',
    'description' => null,
])

<div class="flex min-h-[calc(100vh-12rem)] items-center justify-center">
    <div class="w-full max-w-md rounded-xl border border-border bg-card p-8 shadow-sm">
        <div class="mb-8 text-center">
            <h1 class="text-2xl font-bold text-foreground">
                {{ $title }}
            </h1>

            @if ($description)
                <p class="mt-2 text-sm text-muted">
                    {{ $description }}
                </p>
            @endif
        </div>

        {{ $slot }}
    </div>
</div>