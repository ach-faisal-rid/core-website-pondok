@props([
    'title',
    'description' => null,
    'actionHref' => null,
    'actionLabel' => null,
])

<div {{ $attributes->merge(['class' => 'rounded-xl border border-dashed border-[var(--pondok-line)] bg-white px-6 py-14 text-center shadow-sm']) }}>
    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-pondok-50 text-pondok-800">
        {{ $icon ?? '' }}
        @unless (isset($icon))
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"/></svg>
        @endunless
    </div>
    <h2 class="mt-4 font-display text-2xl font-semibold tracking-wide text-pondok-900">{{ $title }}</h2>
    @if ($description)
        <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-stone-500">{{ $description }}</p>
    @endif
    @if ($actionHref && $actionLabel)
        <a href="{{ $actionHref }}" class="admin-btn-primary mt-6">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5"/></svg>
            {{ $actionLabel }}
        </a>
    @endif
    @isset($action)
        <div class="mt-6 flex justify-center">{{ $action }}</div>
    @endisset
</div>
