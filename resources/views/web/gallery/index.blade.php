@extends('layouts.web')

@section('seo_title', 'Galeri Dokumentasi — '.($settings['site_name'] ?? config('app.name')))
@section('seo_description', 'Dokumentasi kegiatan, fasilitas, dan perjalanan spiritual pondok pesantren.')

@section('content')
    <section class="bg-white">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:py-12 md:py-16">
            <h1 class="pondok-page-title break-words-safe">
                Galeri Dokumentasi
            </h1>
            <p class="pondok-lead">
                Menangkap jejak perjalanan spiritual, akademik, dan kebersamaan santri
                dalam dokumentasi visual yang hangat.
            </p>

            <div class="pondok-filter-row mt-8">
                @foreach ($filters as $filter)
                    <a
                        href="{{ route('galeri.index', array_filter(['kategori' => $filter === 'Semua' ? null : $filter])) }}"
                        @class([
                            'pondok-filter-chip',
                            'bg-pondok-800 text-white' => $kategori === $filter,
                            'bg-stone-100 text-stone-700 hover:bg-stone-200' => $kategori !== $filter,
                        ])
                    >
                        {{ $filter }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 pt-10 pb-12 sm:pt-12 sm:pb-14 md:pt-16 md:pb-16">
        @if ($albums->isEmpty())
            <div class="pondok-card px-5 py-12 text-center sm:px-6 sm:py-16 md:py-20">
                <p class="font-display text-xl text-pondok-900 sm:text-2xl">Belum ada dokumentasi</p>
                <p class="mt-2 text-sm text-[var(--pondok-muted)]">Album galeri akan muncul di sini setelah ditambahkan di panel admin.</p>
            </div>
        @else
            <div class="grid auto-rows-[120px] grid-cols-2 gap-2.5 sm:auto-rows-[180px] sm:gap-3 md:grid-cols-6 md:gap-4 md:auto-rows-[160px] lg:auto-rows-[180px]">
                @foreach ($albums as $index => $album)
                    @php
                        $cover = $album->coverUrl();
                        $isFeatured = $albums->onFirstPage() && $index === 0;
                        $span = match (true) {
                            $isFeatured => 'col-span-2 row-span-2 md:col-span-4 md:row-span-2',
                            $albums->onFirstPage() && $index === 1 => 'col-span-2 row-span-2 md:col-span-2 md:row-span-2',
                            default => 'col-span-1 row-span-2 md:col-span-2',
                        };
                    @endphp
                    <a
                        href="{{ route('galeri.show', $album->slug) }}"
                        class="group relative {{ $span }} overflow-hidden rounded-xl bg-stone-200"
                    >
                        @if ($cover)
                            <img
                                src="{{ $cover }}"
                                alt="{{ $album->title }}"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]"
                                loading="{{ $index < 2 ? 'eager' : 'lazy' }}"
                            >
                        @else
                            <div class="flex h-full items-center justify-center text-sm text-stone-500">Tanpa gambar</div>
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/15 to-transparent opacity-95 transition group-hover:opacity-100"></div>

                        @if ($isFeatured)
                            <span class="absolute right-2 top-2 rounded bg-pondok-800 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-white sm:right-3 sm:top-3 sm:px-2.5 sm:py-1">
                                Terbaru
                            </span>
                        @endif

                        <div class="absolute inset-x-0 bottom-0 p-2.5 text-white sm:p-4">
                            <p class="break-words-safe font-display text-sm font-semibold leading-snug tracking-wide sm:text-lg md:text-xl {{ $isFeatured ? 'text-base sm:text-lg md:text-xl' : '' }}">
                                {{ $album->title }}
                            </p>
                            @if ($album->category)
                                <p class="mt-0.5 text-[10px] text-white/80 sm:mt-1 sm:text-xs">{{ $album->category }} · {{ $album->media_count }} media</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            @if ($albums->hasMorePages())
                <div class="mt-8 flex justify-center sm:mt-10">
                    <a
                        href="{{ $albums->nextPageUrl() }}"
                        class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.18em] text-pondok-900 hover:text-pondok-700"
                    >
                        Tampilkan Lebih Banyak
                        <span aria-hidden="true">→</span>
                    </a>
                </div>
            @elseif ($albums->previousPageUrl())
                <div class="mt-8 flex justify-center sm:mt-10">
                    <a
                        href="{{ route('galeri.index', array_filter(['kategori' => $kategori === 'Semua' ? null : $kategori])) }}"
                        class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.18em] text-pondok-900 hover:text-pondok-700"
                    >
                        Kembali ke Awal
                        <span aria-hidden="true">←</span>
                    </a>
                </div>
            @endif
        @endif
    </section>

    <section class="bg-pondok-900">
        <div class="mx-auto flex max-w-6xl flex-col gap-6 px-4 py-10 sm:gap-8 sm:py-12 md:flex-row md:items-center md:justify-between md:py-14">
            <div class="max-w-xl text-white">
                <h2 class="break-words-safe font-display text-2xl font-semibold tracking-wide sm:text-3xl md:text-4xl">
                    Ikuti Perjalanan Kami
                </h2>
                <p class="mt-3 text-sm leading-relaxed text-pondok-100/80 md:text-base">
                    Dapatkan pembaruan dokumentasi kegiatan dan momen berharga pondok
                    langsung ke surel Anda.
                </p>
            </div>

            <form
                method="POST"
                action="{{ route('galeri.subscribe') }}"
                class="pondok-cta-stack w-full max-w-md sm:flex-row"
            >
                @csrf
                @if ($kategori !== 'Semua')
                    <input type="hidden" name="kategori" value="{{ $kategori }}">
                @endif
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    placeholder="Alamat Email Anda"
                    class="w-full rounded-lg border-0 px-4 py-3 text-base text-stone-800 placeholder:text-stone-400 focus:ring-2 focus:ring-white/40 sm:text-sm"
                >
                <button
                    type="submit"
                    class="w-full shrink-0 rounded-lg border border-white/40 bg-pondok-800 px-5 py-3 text-xs font-bold uppercase tracking-wider text-white hover:bg-pondok-700 sm:w-auto"
                >
                    Langganan
                </button>
            </form>
        </div>
        @error('email')
            <div class="mx-auto max-w-6xl px-4 pb-6 text-sm text-rose-200">{{ $message }}</div>
        @enderror
        <div class="border-t border-white/10"></div>
    </section>
@endsection
