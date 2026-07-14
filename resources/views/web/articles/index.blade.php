@extends('layouts.web')

@section('seo_title', 'Kabar & Artikel Pondok — '.($settings['site_name'] ?? config('app.name')))
@section('seo_description', 'Berita, kegiatan, prestasi, dan tulisan dari lingkungan pondok pesantren.')

@section('content')
    <section class="bg-white">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:py-12 md:py-16">
            <h1 class="pondok-page-title break-words-safe">
                Kabar &amp; Artikel Pondok
            </h1>
            <p class="pondok-lead">
                Ikuti perkembangan terkini seputar akademik, kegiatan, prestasi,
                dan opini dari lingkungan pondok pesantren.
            </p>

            <div class="mt-8 flex flex-col gap-4 sm:mt-10 lg:flex-row lg:items-center lg:justify-between">
                <nav class="pondok-filter-row text-sm font-semibold text-stone-700">
                    @foreach ($filters as $filter)
                        <a
                            href="{{ route('artikel.index', array_filter(['kategori' => $filter === 'Semua' ? null : $filter, 'q' => $q ?: null])) }}"
                            @class([
                                'pondok-filter-chip whitespace-nowrap pb-1 transition hover:text-pondok-800',
                                'border-b-2 border-pondok-800 text-pondok-900' => $kategori === $filter,
                                'border-b-2 border-transparent' => $kategori !== $filter,
                            ])
                        >
                            {{ $filter }}
                        </a>
                    @endforeach
                </nav>

                <form method="GET" action="{{ route('artikel.index') }}" class="relative w-full lg:max-w-xs">
                    @if ($kategori !== 'Semua')
                        <input type="hidden" name="kategori" value="{{ $kategori }}">
                    @endif
                    <input
                        type="search"
                        name="q"
                        value="{{ $q }}"
                        placeholder="Cari artikel..."
                        class="pondok-input !mt-0 pl-10"
                    >
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-stone-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14Z" />
                        </svg>
                    </span>
                </form>
            </div>
        </div>
    </section>

    <section class="bg-[var(--pondok-surface)]">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:py-12 md:py-14">
            @if ($articles->isEmpty())
                <div class="pondok-card px-5 py-12 text-center sm:px-6 sm:py-16">
                    <p class="font-display text-xl text-pondok-900 sm:text-2xl">Belum ada artikel</p>
                    <p class="mt-2 text-sm text-[var(--pondok-muted)] sm:text-base">
                        @if ($q !== '' || $kategori !== 'Semua')
                            Tidak ada hasil untuk filter atau pencarian ini.
                        @else
                            Artikel yang sudah dipublikasikan akan muncul di sini.
                        @endif
                    </p>
                </div>
            @else
                @php
                    $items = $articles->getCollection();
                    $featured = $articles->onFirstPage() ? $items->first() : null;
                    $side = $articles->onFirstPage() ? $items->slice(1, 1)->first() : null;
                    $rest = $articles->onFirstPage() ? $items->slice(2) : $items;
                @endphp

                @if ($featured)
                    <div class="grid gap-5 lg:grid-cols-3">
                        <a href="{{ route('artikel.show', $featured->slug) }}" class="pondok-card group overflow-hidden lg:col-span-2 lg:flex">
                            <div class="lg:w-[48%]">
                                @if ($featured->thumbnailUrl())
                                    <img src="{{ $featured->thumbnailUrl() }}" alt="{{ $featured->title }}" class="h-48 w-full object-cover sm:h-56 lg:h-full">
                                @else
                                    <div class="flex h-48 items-center justify-center bg-stone-200 text-stone-500 sm:h-56 lg:h-full">Tanpa gambar</div>
                                @endif
                            </div>
                            <div class="flex flex-1 flex-col justify-center p-4 sm:p-6 lg:p-7">
                                <div class="flex flex-wrap items-center gap-3">
                                    <span class="rounded px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider {{ $featured->categoryBadgeClass() }}">
                                        {{ $featured->categoryLabel() }}
                                    </span>
                                    @if ($featured->published_at)
                                        <span class="text-[11px] font-semibold uppercase tracking-wide text-stone-500">
                                            {{ $featured->published_at->translatedFormat('d F Y') }}
                                        </span>
                                    @endif
                                </div>
                                <h2 class="mt-3 break-words-safe font-display text-xl font-semibold leading-snug tracking-wide text-pondok-900 group-hover:text-pondok-700 sm:text-2xl md:text-3xl">
                                    {{ $featured->title }}
                                </h2>
                                <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-[var(--pondok-muted)]">
                                    {{ $featured->excerpt(160) }}
                                </p>
                                <span class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-pondok-900">
                                    Baca Selengkapnya <span aria-hidden="true">→</span>
                                </span>
                            </div>
                        </a>

                        @if ($side)
                            @include('web.articles._card', ['article' => $side])
                        @endif
                    </div>
                @endif

                @if ($rest->isNotEmpty())
                    <div @class(['grid gap-5 sm:grid-cols-2 lg:grid-cols-3', 'mt-5' => (bool) $featured])>
                        @foreach ($rest as $article)
                            @include('web.articles._card', ['article' => $article])
                        @endforeach
                    </div>
                @endif

                <div class="mt-10 flex justify-center overflow-x-auto sm:mt-12">
                    {{ $articles->onEachSide(1)->links('pagination.pondok') }}
                </div>
            @endif
        </div>
    </section>
@endsection
