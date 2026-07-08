@props([
    'label' => null,
    'name',
    'type' => 'text',
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="label">
            {{ $label }}
        </label>
    @endif

    @if ($type === 'textarea')
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $attributes->merge(['class' => 'textarea min-h-32 w-full']) }}
        >{{ old($name) }}</textarea>
    @else
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="{{ $type }}"
            value="{{ old($name) }}"
            {{ $attributes->merge(['class' => 'input w-full']) }}
        >
    @endif

    <x-forms.error :name="$name" />
</div>