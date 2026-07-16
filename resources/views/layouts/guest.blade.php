<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Masuk' }} &mdash; {{ $settings['site_name'] ?? config('app.name') }}</title>
    @if (! empty($settings['favicon']))
        <link rel="icon" href="/storage/{{ ltrim($settings['favicon'], '/') }}?v={{ md5($settings['favicon']) }}">
    @endif
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:500,600,700|plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased text-stone-800">
    <div class="flex min-h-screen">
        {{-- Brand panel --}}
        <aside class="relative hidden w-[46%] overflow-hidden bg-pondok-950 text-white lg:flex lg:flex-col">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,_#1f6b4f_0%,_transparent_55%),radial-gradient(ellipse_at_bottom_right,_#0f3a2d_0%,_#061510_70%)]"></div>
            <div class="absolute -right-16 top-24 h-64 w-64 rounded-full border border-white/10"></div>
            <div class="absolute -left-10 bottom-32 h-40 w-40 rounded-full bg-emerald-500/10"></div>

            <div class="relative z-10 flex flex-1 flex-col justify-between p-10 xl:p-12">
                <div>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                        @if (!empty($settings['logo']))
                            <img src="/storage/{{ ltrim($settings['logo'], '/') }}" alt="{{ $settings['site_name'] ?? 'Logo' }}" class="h-10 w-auto brightness-0 invert">
                        @else
                            <span class="font-display text-2xl font-semibold tracking-wide">
                                {{ $settings['site_name'] ?? 'Pesantren Digital' }}
                            </span>
                        @endif
                    </a>
                </div>

                <div class="max-w-md">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-300/90">Panel Administrasi</p>
                    <h1 class="mt-4 font-display text-4xl font-semibold leading-tight tracking-wide xl:text-5xl">
                        Kelola konten pondok dengan tenang dan terarah.
                    </h1>
                    <p class="mt-5 text-sm leading-relaxed text-pondok-100/80 xl:text-base">
                        {{ $settings['site_tagline'] ?? 'Membangun generasi berilmu, berakhlak, dan siap berkhidmat untuk umat.' }}
                    </p>

                    <div class="mt-10 grid grid-cols-3 gap-3">
                        <div class="rounded-xl border border-white/15 bg-white/5 p-4">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-400/20 text-emerald-200">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6 4h10a1 1 0 0 1 1 1v15l-6-3-6 3V5a1 1 0 0 1 1-1Z"/></svg>
                            </div>
                            <p class="mt-3 text-xs font-medium text-white/80">Artikel</p>
                        </div>
                        <div class="rounded-xl border border-white/15 bg-white/5 p-4">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-400/20 text-emerald-200">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7Z"/><circle cx="9" cy="9" r="1.2"/></svg>
                            </div>
                            <p class="mt-3 text-xs font-medium text-white/80">Galeri</p>
                        </div>
                        <div class="rounded-xl border border-white/15 bg-white/5 p-4">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-400/20 text-emerald-200">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M7 3.5h7l3 3V20a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4.5a1 1 0 0 1 1-1Z"/></svg>
                            </div>
                            <p class="mt-3 text-xs font-medium text-white/80">Konten</p>
                        </div>
                    </div>
                </div>

                <p class="text-xs text-white/50">
                    © {{ date('Y') }} {{ $settings['site_name'] ?? 'Pesantren Digital' }}
                </p>
            </div>
        </aside>

        {{-- Form panel --}}
        <main class="flex flex-1 flex-col bg-[var(--pondok-surface)]">
            <div class="flex flex-1 flex-col justify-center px-5 py-10 sm:px-8 lg:px-12 xl:px-16">
                <div class="mx-auto w-full max-w-md">
                    <div class="mb-8 lg:hidden">
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
                            @if (!empty($settings['logo']))
                                <img src="/storage/{{ ltrim($settings['logo'], '/') }}" alt="" class="h-9 w-auto">
                            @else
                                <span class="font-display text-2xl font-semibold text-pondok-900">
                                    {{ $settings['site_name'] ?? 'Pesantren Digital' }}
                                </span>
                            @endif
                        </a>
                    </div>

                    {{ $slot }}
                </div>
            </div>

            <footer class="border-t border-[var(--pondok-line)] px-5 py-4 text-center text-xs text-stone-500 sm:px-8">
                {{ $settings['footer_text'] ?? ('© '.date('Y').' '.($settings['site_name'] ?? 'Pesantren Digital')) }}
                ·
                <a href="{{ route('home') }}" class="text-pondok-800 hover:underline">Kembali ke website</a>
            </footer>
        </main>
    </div>
    <x-toast />
    @livewireScripts
</body>
</html>
