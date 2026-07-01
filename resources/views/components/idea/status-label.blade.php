@props([
    'status',
])

@php
    $value = $status instanceof \App\Enums\IdeaStatus ? $status->value : $status;

    $label = $status instanceof \App\Enums\IdeaStatus
        ? $status->label()
        : str($value)->replace('_', ' ')->title();

    $classes = match ($value) {
        'completed' => 'border-primary/30 bg-primary/10 text-primary',
        'in_progress' => 'border-blue-400/30 bg-blue-400/10 text-blue-300',
        default => 'border-yellow-400/30 bg-yellow-400/10 text-yellow-300',
    };
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full border px-2.5 py-1 text-xs font-medium ' . $classes]) }}>
    {{ $label }}
</span>