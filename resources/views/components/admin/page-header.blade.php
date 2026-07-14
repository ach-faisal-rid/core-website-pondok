@props([
    'title',
    'description' => null,
])

<div {{ $attributes->merge(['class' => 'mb-6 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between']) }}>
    <div class="min-w-0">
        <h1 class="font-display text-3xl font-semibold tracking-wide text-pondok-900 sm:text-4xl">{{ $title }}</h1>
        @if ($description)
            <p class="mt-2 max-w-2xl text-sm leading-relaxed text-[var(--pondok-muted)]">{{ $description }}</p>
        @endif
    </div>
    @isset($action)
        <div class="flex shrink-0 flex-wrap items-center gap-2">
            {{ $action }}
        </div>
    @endisset
</div>
