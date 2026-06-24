@props(['name'])

@error($name)
    <p class="mt-2 text-sm text-error">
        {{ $message }}
    </p>
@enderror