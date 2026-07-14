<a href="{{ route('artikel.show', $article->slug) }}" class="pondok-card group flex h-full flex-col overflow-hidden">
    @if ($article->thumbnailUrl())
        <img src="{{ $article->thumbnailUrl() }}" alt="{{ $article->title }}" class="aspect-[16/10] w-full object-cover transition duration-300 group-hover:opacity-95">
    @else
        <div class="flex aspect-[16/10] items-center justify-center bg-stone-200 text-sm text-stone-500">Tanpa gambar</div>
    @endif

    <div class="flex flex-1 flex-col p-4 sm:p-5">
        <div class="flex flex-wrap items-center gap-3">
            <span class="rounded px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider {{ $article->categoryBadgeClass() }}">
                {{ $article->categoryLabel() }}
            </span>
            @if ($article->published_at)
                <span class="text-[11px] font-semibold uppercase tracking-wide text-stone-500">
                    {{ $article->published_at->translatedFormat('d F Y') }}
                </span>
            @endif
        </div>

        <h2 class="mt-3 break-words-safe font-display text-lg font-semibold leading-snug tracking-wide text-pondok-900 group-hover:text-pondok-700 sm:text-xl">
            {{ $article->title }}
        </h2>

        <p class="mt-2 line-clamp-3 flex-1 text-sm leading-relaxed text-[var(--pondok-muted)]">
            {{ $article->excerpt() }}
        </p>

        <span class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-pondok-900">
            Baca Selengkapnya <span aria-hidden="true">→</span>
        </span>
    </div>
</a>
