@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="inline-flex items-center gap-2">
        @if ($paginator->onFirstPage())
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-md border border-[var(--pondok-line)] text-stone-300">&lsaquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex h-10 w-10 items-center justify-center rounded-md border border-[var(--pondok-line)] bg-white text-pondok-900 hover:bg-pondok-50" rel="prev">&lsaquo;</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="inline-flex h-10 min-w-10 items-center justify-center px-2 text-stone-400">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="inline-flex h-10 min-w-10 items-center justify-center rounded-md bg-pondok-800 px-3 text-sm font-semibold text-white">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="inline-flex h-10 min-w-10 items-center justify-center rounded-md border border-[var(--pondok-line)] bg-white px-3 text-sm font-semibold text-pondok-900 hover:bg-pondok-50">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex h-10 w-10 items-center justify-center rounded-md border border-[var(--pondok-line)] bg-white text-pondok-900 hover:bg-pondok-50" rel="next">&rsaquo;</a>
        @else
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-md border border-[var(--pondok-line)] text-stone-300">&rsaquo;</span>
        @endif
    </nav>
@endif
