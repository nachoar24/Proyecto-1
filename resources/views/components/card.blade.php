<div {{ $attributes->merge(['class' => 'card bg-base-200 shadow-xl']) }}>
    <div class="card-body">
        {{ $slot }}
    </div>
</div>