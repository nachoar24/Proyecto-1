@props([
    'label',
    'name',
    'type' => 'text',
])

<div>
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
    </label>

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name) }}"
        {{ $attributes->merge(['class' => 'form-input']) }}
    >

    @error($name)
        <p class="form-error">
            {{ $message }}
        </p>
    @enderror
</div>