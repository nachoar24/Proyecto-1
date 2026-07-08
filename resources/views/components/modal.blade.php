@props([
    'name',
    'title',
])

@php
    $titleId = 'modal-' . str($name)->slug() . '-title';
@endphp

<div
    x-data="{ show: false, modalName: @js($name) }"
    x-show="show"
    x-cloak
    x-on:open-modal.window="if ($event.detail === modalName) show = true"
    x-on:close-modal.window="show = false"
    x-on:keydown.escape.window="show = false"
    x-bind:aria-hidden="! show"
    x-transition:enter="duration-200 ease-out"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="duration-150 ease-in"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center bg-background/80 p-6 backdrop-blur-sm"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $titleId }}"
    tabindex="-1"
    x-on:click.self="show = false"
>
    <x-card class="relative max-h-[85vh] w-full max-w-2xl overflow-y-auto shadow-2xl">
        <header class="flex items-start justify-between gap-4">
            <h2 id="{{ $titleId }}" class="text-xl font-bold text-foreground">
                {{ $title }}
            </h2>

            <button
                type="button"
                class="text-sm font-semibold text-muted hover:text-foreground"
                x-on:click="show = false"
                aria-label="Cerrar modal"
            >
                Cerrar
            </button>
        </header>

        <div class="mt-6">
            {{ $slot }}
        </div>
    </x-card>
</div>