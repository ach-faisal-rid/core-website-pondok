@extends('layouts.web')

@section('seo_title', 'Kontak & Alamat — '.($settings['site_name'] ?? config('app.name')))
@section('seo_description', 'Hubungi kami untuk informasi pendaftaran dan program pendidikan.')

@section('content')
    <section class="border-b border-[var(--pondok-line)] bg-white">
        <div class="mx-auto max-w-6xl px-4 py-10 sm:py-12 md:py-16">
            <h1 class="pondok-page-title break-words-safe">
                Kontak &amp; Alamat
            </h1>
            <p class="pondok-lead">
                Silakan hubungi kami melalui informasi di bawah ini, atau isi formulir
                untuk menanyakan seputar pendaftaran dan program pendidikan.
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-8 sm:py-10 md:py-14">
        <div class="grid gap-6 sm:gap-8 lg:grid-cols-2 lg:gap-10">
            {{-- Left: info + map --}}
            <div class="space-y-5 sm:space-y-6">
                <div class="pondok-card p-5 sm:p-6 md:p-7">
                    <h2 class="sr-only">Informasi Institusi</h2>
                    <ul class="space-y-5 sm:space-y-6">
                        @if (!empty($settings['address']))
                            <li class="flex gap-3 sm:gap-4">
                                <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-md bg-pondok-800 text-white">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s7-5.33 7-11a7 7 0 1 0-14 0c0 5.67 7 11 7 11Z" />
                                        <circle cx="12" cy="10" r="2.5" />
                                    </svg>
                                </span>
                                <div class="min-w-0">
                                    <p class="text-xs font-semibold uppercase tracking-wider text-stone-500">Alamat</p>
                                    <p class="mt-1 break-words-safe whitespace-pre-line text-sm text-stone-800 sm:text-base">{{ $settings['address'] }}</p>
                                </div>
                            </li>
                        @endif

                        @if (!empty($settings['phone']))
                            <li class="flex gap-3 sm:gap-4">
                                <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-md bg-pondok-800 text-white">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.5 5.5c0-.8.7-1.5 1.5-1.5h2.1c.7 0 1.3.5 1.4 1.2l.5 2.6c.1.6-.1 1.2-.6 1.6l-1.3 1c1.2 2.3 3.1 4.2 5.4 5.4l1-1.3c.4-.5 1-.7 1.6-.6l2.6.5c.7.1 1.2.7 1.2 1.4V19c0 .8-.7 1.5-1.5 1.5C9.9 20.5 3.5 14.1 3.5 5.5Z" />
                                    </svg>
                                </span>
                                <div class="min-w-0">
                                    <p class="text-xs font-semibold uppercase tracking-wider text-stone-500">Telepon</p>
                                    <a href="tel:{{ $settings['phone'] }}" class="mt-1 block break-words-safe text-sm text-stone-800 hover:text-pondok-800 sm:text-base">{{ $settings['phone'] }}</a>
                                </div>
                            </li>
                        @endif

                        @if (!empty($settings['whatsapp']))
                            <li class="flex gap-3 sm:gap-4">
                                <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-md bg-pondok-800 text-white">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 18.5 5 20l.7-3.2A8 8 0 1 1 20 12a8 8 0 0 1-12.5 6.5Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 10.5h.01M12 10.5h.01M15 10.5h.01" />
                                    </svg>
                                </span>
                                <div class="min-w-0">
                                    <p class="text-xs font-semibold uppercase tracking-wider text-stone-500">WhatsApp</p>
                                    <a
                                        href="https://wa.me/{{ preg_replace('/\D+/', '', $settings['whatsapp']) }}"
                                        class="mt-1 block break-words-safe text-sm text-stone-800 hover:text-pondok-800 sm:text-base"
                                        target="_blank"
                                        rel="noopener"
                                    >{{ $settings['whatsapp'] }}</a>
                                </div>
                            </li>
                        @endif

                        @if (!empty($settings['email']))
                            <li class="flex gap-3 sm:gap-4">
                                <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-md bg-pondok-800 text-white">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 7.5A1.5 1.5 0 0 1 5.5 6h13A1.5 1.5 0 0 1 20 7.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 16.5v-9Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m5 8 7 5 7-5" />
                                    </svg>
                                </span>
                                <div class="min-w-0">
                                    <p class="text-xs font-semibold uppercase tracking-wider text-stone-500">Email</p>
                                    <a href="mailto:{{ $settings['email'] }}" class="mt-1 block break-words-safe text-sm text-stone-800 hover:text-pondok-800 sm:text-base">{{ $settings['email'] }}</a>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="pondok-card overflow-hidden">
                    @if (!empty($settings['maps_embed']))
                        <div class="aspect-[4/3] w-full sm:aspect-[16/10] [&>iframe]:h-full [&>iframe]:w-full [&>iframe]:border-0">
                            {!! $settings['maps_embed'] !!}
                        </div>
                    @else
                        <div class="relative aspect-[4/3] bg-stone-200 sm:aspect-[16/10]">
                            <iframe
                                title="Peta lokasi pondok"
                                class="h-full w-full border-0"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                src="https://maps.google.com/maps?q={{ urlencode($settings['address'] ?? 'Indonesia') }}&z=14&output=embed"
                            ></iframe>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right: form card --}}
            <div class="pondok-card p-5 sm:p-6 md:p-8">
                <h2 class="font-display text-2xl font-semibold tracking-wide text-pondok-900 sm:text-3xl md:text-4xl">Kirim Pesan</h2>
                <div class="mt-5 sm:mt-6">
                    <livewire:web.contact-form />
                </div>
            </div>
        </div>
    </section>
@endsection
