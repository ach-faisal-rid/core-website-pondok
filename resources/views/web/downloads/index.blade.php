@extends('layouts.web')

@section('seo_title', 'Pusat Unduhan — '.($settings['site_name'] ?? config('app.name')))
@section('seo_description', 'Akses dokumen resmi pondok: formulir, kalender akademik, dan publikasi.')

@section('content')
    @php
        $accentMap = [
            'green' => [
                'icon' => 'bg-emerald-50 text-pondok-800',
                'chip' => 'bg-stone-100 text-stone-600',
            ],
            'blue' => [
                'icon' => 'bg-sky-50 text-sky-700',
                'chip' => 'bg-stone-100 text-stone-600',
            ],
            'amber' => [
                'icon' => 'bg-amber-50 text-amber-700',
                'chip' => 'bg-stone-100 text-stone-600',
            ],
        ];
    @endphp

    <section class="bg-white">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:py-12 md:py-16">
            <h1 class="pondok-page-title break-words-safe">
                Pusat Unduhan
            </h1>
            <p class="pondok-lead">
                Akses berbagai dokumen resmi pondok pesantren, mulai dari formulir pendaftaran,
                kalender akademik, hingga publikasi tahunan.
            </p>
        </div>
    </section>

    <section class="border-y border-[var(--pondok-line)] bg-stone-100/80">
        <div class="mx-auto flex max-w-6xl flex-col gap-4 px-4 py-4 lg:flex-row lg:items-center lg:justify-between">
            <div class="pondok-filter-row">
                @foreach ($filters as $filter)
                    <a
                        href="{{ route('download.index', array_filter(['kategori' => $filter === 'Semua' ? null : $filter, 'q' => $q ?: null])) }}"
                        @class([
                            'pondok-filter-chip',
                            'bg-pondok-800 text-white' => $kategori === $filter,
                            'border border-[var(--pondok-line)] bg-white text-stone-700 hover:border-pondok-700 hover:text-pondok-800' => $kategori !== $filter,
                        ])
                    >
                        {{ $filter }}
                    </a>
                @endforeach
            </div>

            <form method="GET" action="{{ route('download.index') }}" class="relative w-full lg:max-w-xs">
                @if ($kategori !== 'Semua')
                    <input type="hidden" name="kategori" value="{{ $kategori }}">
                @endif
                <input
                    type="search"
                    name="q"
                    value="{{ $q }}"
                    placeholder="Cari dokumen..."
                    class="pondok-input !mt-0 pl-10"
                >
                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-stone-400">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14Z" />
                    </svg>
                </span>
            </form>
        </div>
    </section>

    <section class="mx-auto max-w-6xl space-y-10 px-4 py-10 sm:space-y-12 sm:py-12 md:py-14">
        @forelse ($grouped as $category => $items)
            <div>
                <div class="mb-4 flex items-center gap-3 sm:mb-5">
                    @php $sectionAccent = $items->first()->accent(); @endphp
                    <span @class([
                        'inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-md',
                        $accentMap[$sectionAccent]['icon'],
                    ])>
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 3.5h7l3 3V20a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4.5a1 1 0 0 1 1-1Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 3.5V7h3" />
                        </svg>
                    </span>
                    <h2 class="break-words-safe font-display text-xl font-semibold tracking-wide text-pondok-900 sm:text-2xl md:text-3xl">
                        {{ $category }}
                    </h2>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-5 xl:grid-cols-3">
                    @foreach ($items as $download)
                        @php $accent = $accentMap[$download->accent()]; @endphp
                        <article class="pondok-card flex h-full flex-col p-4 sm:p-5">
                            <div class="flex items-start justify-between gap-3">
                                <span @class(['inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-lg', $accent['icon']])>
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 3.5h7l3 3V20a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4.5a1 1 0 0 1 1-1Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 3.5V7h3M9 12h6M9 15h4" />
                                    </svg>
                                </span>
                                <span @class(['rounded-md px-2.5 py-1 text-xs font-semibold', $accent['chip']])>
                                    {{ $download->extension() }} · {{ $download->humanSize() }}
                                </span>
                            </div>

                            <h3 class="mt-4 break-words-safe font-display text-lg font-semibold leading-snug tracking-wide text-pondok-900 sm:text-xl">
                                {{ $download->title }}
                            </h3>

                            @if ($download->description)
                                <p class="mt-2 line-clamp-2 flex-1 text-sm leading-relaxed text-[var(--pondok-muted)]">
                                    {{ $download->description }}
                                </p>
                            @else
                                <p class="mt-2 line-clamp-2 flex-1 text-sm leading-relaxed text-[var(--pondok-muted)]">
                                    Dokumen resmi yang dapat diunduh untuk keperluan administrasi dan informasi pondok.
                                </p>
                            @endif

                            <a
                                href="{{ route('download.file', $download) }}"
                                class="mt-5 inline-flex w-full items-center justify-between rounded-lg bg-stone-100 px-4 py-3 text-sm font-semibold text-stone-800 transition hover:bg-stone-200"
                            >
                                <span>Unduh Sekarang</span>
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v12m0 0 4-4m-4 4-4-4M5 19h14" />
                                </svg>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="pondok-card px-5 py-12 text-center sm:px-6 sm:py-14">
                <p class="font-display text-xl text-pondok-900 sm:text-2xl">Belum ada dokumen</p>
                <p class="mt-2 text-sm text-[var(--pondok-muted)]">
                    @if ($q !== '' || $kategori !== 'Semua')
                        Tidak ada hasil untuk filter atau pencarian ini.
                    @else
                        Dokumen unduhan akan muncul di sini setelah ditambahkan melalui panel admin.
                    @endif
                </p>
            </div>
        @endforelse
    </section>

    <section class="bg-pondok-900">
        <div class="mx-auto max-w-3xl px-4 py-12 text-center text-white sm:py-14">
            <h2 class="break-words-safe font-display text-2xl font-semibold tracking-wide sm:text-3xl md:text-4xl">
                Mengalami Kesulitan Mengunduh?
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-sm leading-relaxed text-pondok-100/80 md:text-base">
                Tim administrasi kami siap membantu Anda mendapatkan dokumen yang dibutuhkan
                atau menjawab pertanyaan teknis seputar unduhan.
            </p>
            <div class="pondok-cta-stack mx-auto mt-7 max-w-md justify-center sm:mt-8 sm:max-w-none">
                @if (!empty($settings['whatsapp']))
                    <a
                        href="https://wa.me/{{ preg_replace('/\D+/', '', $settings['whatsapp']) }}"
                        class="inline-flex items-center justify-center rounded-lg bg-white px-5 py-3 text-sm font-semibold text-pondok-900 hover:bg-pondok-50"
                        target="_blank"
                        rel="noopener"
                    >
                        Hubungi Kami via WhatsApp
                    </a>
                @endif
                @if (!empty($settings['email']))
                    <a
                        href="mailto:{{ $settings['email'] }}"
                        class="inline-flex items-center justify-center rounded-lg border border-white/40 px-5 py-3 text-sm font-semibold text-white hover:bg-white/10"
                    >
                        Kirim Email ke Admin
                    </a>
                @endif
            </div>
        </div>
        <div class="border-t border-white/10"></div>
    </section>
@endsection
