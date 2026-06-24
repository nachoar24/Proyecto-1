@props(['href' => '#'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'card bg-base-200 shadow-xl transition hover:bg-base-300']) }}>
    <div class="card-body">
        {{ $slot }}
    </div>
</a>