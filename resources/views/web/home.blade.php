@extends('layouts.web')

@section('seo_title', ($settings['seo_title'] ?? ($settings['site_name'] ?? 'Beranda')))
@section('seo_description', $settings['seo_description'] ?? ($settings['site_tagline'] ?? ''))

@section('content')
    {{-- Hero --}}
    <section class="relative isolate min-h-[68vh] overflow-hidden bg-pondok-950 text-white sm:min-h-[72vh] md:min-h-[78vh]">
        @if ($heroImage)
            <img
                src="{{ str_starts_with($heroImage, 'http') ? $heroImage : asset('storage/'.$heroImage) }}"
                alt="{{ $siteName }}"
                class="absolute inset-0 h-full w-full object-cover"
            >
        @else
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_#1f6b4f_0%,_#0a2820_50%,_#061510_100%)]"></div>
        @endif
        <div class="absolute inset-0 bg-pondok-950/55"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-pondok-950 via-transparent to-pondok-950/30"></div>

        <div class="relative mx-auto flex min-h-[68vh] max-w-4xl flex-col items-center justify-center px-4 py-16 text-center sm:min-h-[72vh] sm:py-20 md:min-h-[78vh] md:py-24">
            <h1 class="break-words-safe font-display text-3xl font-semibold leading-tight tracking-wide sm:text-4xl md:text-6xl">
                {{ $heroTitle }}
            </h1>
            <p class="mt-4 max-w-2xl text-sm leading-relaxed text-white/85 sm:mt-6 sm:text-base md:text-lg">
                {{ $heroSubtitle }}
            </p>
            <div class="pondok-cta-stack mt-7 sm:mt-9">
                <a href="{{ route('profil.index') }}" class="inline-flex rounded-lg bg-white px-6 py-3 text-sm font-semibold text-pondok-900 hover:bg-pondok-50">
                    Jelajahi Profil
                </a>
                <a href="{{ route('kontak') }}" class="inline-flex rounded-lg border border-white/50 px-6 py-3 text-sm font-semibold text-white hover:bg-white/10">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section class="bg-pondok-900">
        <div class="mx-auto grid max-w-6xl grid-cols-1 gap-6 px-4 py-8 sm:grid-cols-3 sm:gap-4 sm:py-12">
            @foreach ($stats as $stat)
                <div class="border-b border-white/10 pb-6 text-center text-white last:border-b-0 last:pb-0 sm:border-b-0 sm:pb-0">
                    <p class="font-display text-3xl font-semibold tracking-wide sm:text-4xl md:text-5xl">{{ $stat['value'] }}</p>
                    <p class="mt-2 text-sm text-pondok-100/80 md:text-base">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Panca Jiwa --}}
    <section class="bg-white">
        <div class="mx-auto max-w-6xl pondok-section">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="pondok-section-title">Panca Jiwa Pondok</h2>
                <div class="mx-auto mt-4 h-px w-16 bg-pondok-800"></div>
                <p class="pondok-lead mx-auto">
                    Lima nilai yang menjadi napas kehidupan santri dalam belajar, berkarya, dan berkhidmat.
                </p>
            </div>

            <div class="mt-10 grid gap-4 sm:mt-12 sm:grid-cols-2 lg:grid-cols-5">
                @foreach ($pancaJiwa as $jiwa)
                    <div class="pondok-card px-4 py-6 text-center sm:px-5 sm:py-7">
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-md bg-pondok-800 text-white">
                            @include('web.profil._icon', ['icon' => $jiwa['icon'] ?? 'heart'])
                        </div>
                        <h3 class="mt-4 font-display text-lg font-semibold text-pondok-900 sm:mt-5 sm:text-xl">
                            {{ $jiwa['title'] }}
                        </h3>
                        <p class="mt-2 text-sm leading-relaxed text-[var(--pondok-muted)] sm:mt-3">
                            {{ $jiwa['description'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Warta & Kegiatan --}}
    <section class="bg-[var(--pondok-surface)]">
        <div class="mx-auto max-w-6xl pondok-section">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between sm:gap-4">
                <div>
                    <h2 class="pondok-section-title">Warta &amp; Kegiatan</h2>
                    <p class="mt-2 text-sm text-[var(--pondok-muted)] sm:mt-3 md:text-base">
                        Kabar terbaru seputar pendidikan, kegiatan, dan prestasi pondok.
                    </p>
                </div>
                <a href="{{ route('artikel.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-pondok-900 hover:text-pondok-700">
                    Lihat Semua Berita <span aria-hidden="true">→</span>
                </a>
            </div>

            <div class="mt-8 grid gap-5 sm:mt-10 sm:gap-6 md:grid-cols-3">
                @forelse ($latestArticles as $article)
                    <article class="pondok-card flex h-full flex-col overflow-hidden">
                        <a href="{{ route('artikel.show', $article->slug) }}">
                            @if ($article->thumbnailUrl())
                                <img src="{{ $article->thumbnailUrl() }}" alt="{{ $article->title }}" class="aspect-[16/10] w-full object-cover">
                            @else
                                <div class="flex aspect-[16/10] items-center justify-center bg-stone-200 text-sm text-stone-500">Tanpa gambar</div>
                            @endif
                        </a>
                        <div class="flex flex-1 flex-col p-4 sm:p-5">
                            <span class="inline-flex w-fit rounded px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider {{ $article->categoryBadgeClass() }}">
                                {{ $article->categoryLabel() }}
                            </span>
                            <h3 class="mt-3 font-display text-lg font-semibold leading-snug tracking-wide text-pondok-900 sm:text-xl">
                                <a href="{{ route('artikel.show', $article->slug) }}" class="hover:text-pondok-700 break-words-safe">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <p class="mt-2 line-clamp-3 flex-1 text-sm leading-relaxed text-[var(--pondok-muted)]">
                                {{ $article->excerpt(120) }}
                            </p>
                            <div class="mt-5 flex items-center justify-between border-t border-[var(--pondok-line)] pt-4 text-xs text-stone-500">
                                <span>
                                    @if ($article->published_at)
                                        {{ $article->published_at->translatedFormat('d F Y') }}
                                    @endif
                                </span>
                                <a href="{{ route('artikel.show', $article->slug) }}" class="text-pondok-800 hover:text-pondok-600" aria-label="Baca artikel">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 4h10a1 1 0 0 1 1 1v15l-6-3-6 3V5a1 1 0 0 1 1-1Z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="pondok-card px-5 py-10 text-center sm:px-6 sm:py-12 md:col-span-3">
                        <p class="font-display text-xl text-pondok-900 sm:text-2xl">Belum ada warta</p>
                        <p class="mt-2 text-sm text-[var(--pondok-muted)]">Artikel yang dipublikasikan akan muncul di sini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Penerimaan / pendaftaran santri disembunyikan sementara (belum dibuka). --}}
@endsection
