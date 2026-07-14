@props(['title'])

<div {{ $attributes->merge(['class' => 'mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between']) }}>
    <h1 class="text-2xl font-semibold text-slate-900">{{ $title }}</h1>
    @isset($action)
        <div class="flex flex-wrap items-center gap-2">
            {{ $action }}
        </div>
    @endisset
</div>
