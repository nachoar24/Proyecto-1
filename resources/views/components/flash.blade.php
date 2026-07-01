@if (session('success'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 5000)"
        x-show="show"
        x-transition.opacity.duration.300ms
        class="fixed bottom-6 right-6 z-50 max-w-sm rounded-lg border border-primary/30 bg-primary px-4 py-3 text-sm font-medium text-primary-foreground shadow-lg"
    >
        {{ session('success') }}
    </div>
@endif