@props([
    'title' => null,
    'description' => null,
])

<section {{ $attributes->merge(['class' => 'rounded-xl border border-border bg-card p-6 shadow-sm']) }}>
    @if ($title || $description)
        <header class="mb-6">
            @if ($title)
                <h1 class="text-2xl font-bold text-foreground">
                    {{ $title }}
                </h1>
            @endif

            @if ($description)
                <p class="mt-2 text-sm text-muted">
                    {{ $description }}
                </p>
            @endif
        </header>
    @endif

    {{ $slot }}
</section>