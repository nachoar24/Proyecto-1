@props([
    'name',
])

@error($name)
    <p class="mt-2 text-sm text-red-400">
        {{ $message }}
    </p>
@enderror