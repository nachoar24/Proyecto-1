@props([
    'href' => null,
])

@php
    $classes = 'rounded-2xl border border-border bg-card p-6 text-sm text-muted shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-primary/60 hover:shadow-lg';
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes . ' block']) }}>
        {{ $slot }}
    </a>
@else
    <section {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </section>
@endif