@extends('layouts.web')

@section('seo_title', 'Profil & Sejarah — '.$siteName)
@section('seo_description', $heroSubtitle)

@section('content')
    {{-- Hero --}}
    <section class="relative isolate min-h-[52vh] overflow-hidden bg-pondok-950 text-white sm:min-h-[58vh] md:min-h-[68vh]">
        @if ($heroImage)
            <img
                src="{{ str_starts_with($heroImage, 'http') ? $heroImage : asset('storage/'.$heroImage) }}"
                alt="{{ $siteName }}"
                class="absolute inset-0 h-full w-full object-cover"
            >
        @else
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_#1f6b4f_0%,_#0a2820_55%,_#061510_100%)]"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-pondok-950 via-pondok-950/55 to-pondok-950/25"></div>

        <div class="relative mx-auto flex min-h-[52vh] max-w-4xl flex-col items-center justify-center px-4 py-16 text-center sm:min-h-[58vh] sm:py-20 md:min-h-[68vh] md:py-24">
            <h1 class="break-words-safe font-display text-3xl font-semibold tracking-wide sm:text-5xl md:text-7xl">Profil &amp; Sejarah</h1>
            <p class="mt-4 max-w-2xl font-display text-sm leading-relaxed text-white/85 sm:mt-5 sm:text-base md:text-xl">
                {{ $heroSubtitle }}
            </p>
        </div>
    </section>

    {{-- Sejarah Singkat --}}
    <section class="bg-pondok-950 text-white">
        <div class="mx-auto grid max-w-6xl gap-8 px-4 py-12 sm:gap-10 sm:py-16 md:grid-cols-2 md:items-center md:gap-14 md:py-24">
            <div class="order-2 md:order-1">
                <h2 class="break-words-safe font-display text-2xl font-semibold tracking-wide text-emerald-300 sm:text-3xl md:text-4xl">
                    {{ $sejarah?->title ?? 'Sejarah Singkat' }}
                </h2>
                <div class="prose prose-invert mt-5 max-w-none prose-p:font-display prose-p:text-sm prose-p:leading-relaxed prose-p:text-white/85 sm:mt-6 sm:prose-p:text-base prose-headings:font-display">
                    @if ($sejarah?->body)
                        {!! $sejarah->body !!}
                    @else
                        <p>
                            Pondok ini tumbuh dari kepedulian para ulama untuk menjaga warisan ilmu dan adab.
                            Dari majelis kecil hingga komplek pendidikan, perjalanan ini dijaga dengan ketulusan,
                            kesabaran, dan komitmen membentuk insan yang bermanfaat.
                        </p>
                        <p>
                            Hingga kini, semangat itu terus hidup dalam kegiatan belajar, mengaji, dan berkhidmat
                            kepada masyarakat sekitar.
                        </p>
                    @endif
                </div>
            </div>

            <div class="order-1 mx-auto w-full max-w-sm md:order-2 md:max-w-md">
                <div class="rounded-xl border-4 border-white/90 bg-white p-1.5 shadow-2xl sm:p-2">
                    @if ($founderImage)
                        <img
                            src="{{ str_starts_with($founderImage, 'http') ? $founderImage : asset('storage/'.$founderImage) }}"
                            alt="Pendiri pondok"
                            class="aspect-[3/4] w-full object-cover"
                        >
                    @else
                        <div class="flex aspect-[3/4] items-center justify-center bg-stone-200 text-stone-500">
                            Foto pendiri / pengasuh
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Visi & Misi --}}
    <section class="bg-[var(--pondok-surface)]">
        <div class="mx-auto max-w-6xl pondok-section">
            <div class="text-center">
                <h2 class="pondok-section-title">
                    {{ $visiMisi?->title ?? 'Visi & Misi' }}
                </h2>
                <div class="mx-auto mt-4 h-px w-16 bg-pondok-800"></div>
            </div>

            <div class="mt-8 grid gap-5 sm:mt-12 sm:gap-6 md:grid-cols-2">
                <div class="pondok-card px-5 py-7 text-center sm:px-8 sm:py-10">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center text-pondok-800">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12s3.5-7 9.5-7 9.5 7 9.5 7-3.5 7-9.5 7-9.5-7-9.5-7Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </div>
                    <h3 class="mt-4 font-display text-xl font-semibold text-pondok-900 sm:text-2xl">Visi</h3>
                    <p class="mt-4 font-display text-base italic leading-relaxed text-stone-700 sm:text-lg">
                        “{{ $visi }}”
                    </p>
                </div>

                <div class="pondok-card px-5 py-7 sm:px-8 sm:py-10">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center text-pondok-800">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.5 11 14.5 15.5 10" />
                            <circle cx="12" cy="12" r="9" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-center font-display text-xl font-semibold text-pondok-900 sm:text-2xl">Misi</h3>
                    <ol class="mt-5 space-y-3 sm:mt-6 sm:space-y-4">
                        @foreach ($misi as $index => $item)
                            <li class="flex gap-3 sm:gap-4">
                                <span class="shrink-0 font-display text-sm font-semibold text-pondok-800">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="text-sm leading-relaxed text-stone-700 md:text-base">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>

            @if (filled($motto) || filled($nilai))
                <div class="mx-auto mt-8 max-w-3xl space-y-6 text-center sm:mt-10">
                    @if (filled($motto))
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-pondok-800">Motto</p>
                            <p class="mt-2 font-display text-xl italic text-pondok-900 sm:text-2xl">“{{ $motto }}”</p>
                        </div>
                    @endif
                    @if (filled($nilai))
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-pondok-800">Nilai Pondok</p>
                            <p class="mt-2 text-sm leading-relaxed text-[var(--pondok-muted)] sm:text-base">{{ $nilai }}</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </section>

    {{-- Panca Jiwa --}}
    <section class="bg-pondok-950 text-white">
        <div class="mx-auto max-w-6xl pondok-section">
            <div class="text-center">
                <h2 class="break-words-safe font-display text-3xl font-semibold tracking-wide text-emerald-300 sm:text-4xl md:text-5xl">
                    {{ $pancaSectionTitle }}
                </h2>
                <p class="mx-auto mt-4 max-w-2xl text-sm text-white/75 md:text-base">
                    Lima nilai yang menjadi napas kehidupan santri dalam belajar dan berkhidmat.
                </p>
            </div>

            <div class="mt-10 grid gap-8 sm:mt-14 sm:grid-cols-2 lg:grid-cols-5">
                @foreach ($pancaJiwa as $jiwa)
                    <div class="text-center">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-md border border-emerald-400/50 text-emerald-300 sm:h-16 sm:w-16">
                            @include('web.profil._icon', ['icon' => $jiwa['icon'] ?? 'heart'])
                        </div>
                        <h3 class="mt-4 text-xs font-bold uppercase tracking-[0.2em] text-emerald-300 sm:mt-5">
                            {{ $jiwa['title'] }}
                        </h3>
                        <p class="mt-3 text-sm leading-relaxed text-white/80">
                            {{ $jiwa['description'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Struktur Pengasuh --}}
    <section class="bg-white">
        <div class="mx-auto max-w-6xl pondok-section">
            <div class="text-center">
                <h2 class="pondok-section-title">
                    {{ $struktur?->title ?? 'Struktur Pengasuh' }}
                </h2>
                <p class="pondok-lead mx-auto">
                    Para pengasuh yang membimbing perjalanan ilmu dan adab di pondok.
                </p>
            </div>

            <div class="mx-auto mt-10 grid max-w-4xl gap-8 sm:mt-14 sm:grid-cols-2 sm:gap-10">
                @forelse ($pengasuh as $person)
                    <div class="text-center">
                        <div class="mx-auto max-w-[220px] overflow-hidden rounded-xl bg-stone-200 sm:max-w-xs">
                            @if (!empty($person['photo']))
                                <img
                                    src="{{ asset('storage/'.$person['photo']) }}"
                                    alt="{{ $person['name'] }}"
                                    class="aspect-[3/4] w-full object-cover grayscale"
                                >
                            @else
                                <div class="flex aspect-[3/4] items-center justify-center bg-stone-300 text-stone-500">
                                    Foto pengasuh
                                </div>
                            @endif
                        </div>
                        <h3 class="mt-4 break-words-safe font-display text-xl font-semibold text-pondok-900 sm:mt-5 sm:text-2xl">
                            {{ $person['name'] }}
                        </h3>
                        <p class="mt-2 text-xs font-bold uppercase tracking-[0.18em] text-emerald-700">
                            {{ $person['title'] }}
                        </p>
                    </div>
                @empty
                    <div class="pondok-card px-5 py-8 text-center sm:col-span-2 sm:px-6 sm:py-10">
                        @if ($struktur?->body)
                            <div class="prose prose-stone mx-auto max-w-none prose-headings:font-display prose-headings:text-pondok-900 prose-p:text-sm sm:prose-p:text-base">
                                {!! $struktur->body !!}
                            </div>
                        @else
                            <p class="text-[var(--pondok-muted)]">Data pengasuh belum dilengkapi.</p>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
