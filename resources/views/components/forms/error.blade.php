@props(['name'])

@error($name)
    <p class="mt-1 text-sm text-red-300">
        {{ $message }}
    </p>
@enderror