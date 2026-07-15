<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('seo_title', $settings['seo_title'] ?? ($settings['site_name'] ?? config('app.name')))</title>
    <meta name="description" content="@yield('seo_description', $settings['seo_description'] ?? '')">
    <meta property="og:title" content="@yield('seo_title', $settings['seo_title'] ?? ($settings['site_name'] ?? config('app.name')))">
    <meta property="og:description" content="@yield('seo_description', $settings['seo_description'] ?? '')">
    <meta property="og:type" content="website">
    @if (!empty($settings['favicon']))
        <link rel="icon" href="{{ asset('storage/'.$settings['favicon']) }}">
    @endif
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700|plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-[var(--pondok-surface)] text-stone-900 tracking-tight">
    <header class="border-b border-[var(--pondok-line)] bg-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-4">
            <a href="{{ route('home') }}" class="min-w-0 max-w-[48%] truncate font-display text-xl font-semibold tracking-wide text-pondok-900 sm:max-w-none sm:text-2xl md:text-[1.65rem]">
                @if (!empty($settings['logo']))
                    <img src="{{ asset('storage/'.$settings['logo']) }}" alt="{{ $settings['site_name'] ?? 'Logo' }}" class="h-9 w-auto sm:h-10">
                @else
                    {{ $settings['site_name'] ?? 'Pondok Pesantren' }}
                @endif
            </a>

            <nav class="hidden items-center gap-5 text-[15px] text-stone-600 lg:flex xl:gap-7">
                @foreach ($websiteNav ?? [] as $item)
                    @php $href = $item['url'] ?? '#'; @endphp
                    <a href="{{ $href }}" class="{{ request()->is(ltrim($href, '/') ?: '/') ? 'font-semibold text-pondok-900 underline decoration-2 underline-offset-8' : 'hover:text-pondok-800' }}">{{ $item['label'] ?? '' }}</a>
                @endforeach
            </nav>

            {{-- Menu mobile --}}
            <div class="flex items-center gap-2 sm:gap-3">
                <details class="relative lg:hidden">
                    <summary class="cursor-pointer list-none rounded-lg border border-[var(--pondok-line)] px-3 py-2 text-sm font-semibold text-pondok-900 marker:content-none">
                        Menu
                    </summary>
                    <div class="absolute right-0 z-50 mt-2 w-48 rounded-xl border border-[var(--pondok-line)] bg-white p-2 shadow-lg">
                        @foreach ($websiteNav ?? [] as $item)
                            <a href="{{ $item['url'] ?? '#' }}" class="block rounded-lg px-3 py-2 text-sm hover:bg-pondok-50">{{ $item['label'] ?? '' }}</a>
                        @endforeach
                    </div>
                </details>

                    <a href="{{ route('artikel.index') }}" class="hidden rounded-full p-2 text-pondok-800 hover:bg-pondok-50 sm:inline-flex" aria-label="Cari">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14Z" />
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer @class([
        'bg-pondok-900 text-pondok-50',
        'mt-0' => request()->routeIs('download.*', 'galeri.index'),
        'mt-12 sm:mt-16 md:mt-20' => ! request()->routeIs('download.*', 'galeri.index'),
    ])>
        <div class="mx-auto grid max-w-6xl gap-8 px-4 py-10 sm:gap-10 sm:py-12 md:grid-cols-4">
            <div class="md:col-span-2">
                <p class="break-words-safe font-display text-xl font-semibold tracking-wide sm:text-2xl">{{ $settings['site_name'] ?? 'Pondok Pesantren' }}</p>
                <p class="mt-3 max-w-md text-sm leading-relaxed text-pondok-100/80">
                    {{ $settings['site_tagline'] ?? 'Membangun generasi berilmu, berakhlak, dan siap berkhidmat untuk umat.' }}
                </p>
            </div>
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-pondok-100/70">Tautan</p>
                <div class="mt-3 grid grid-cols-2 gap-2 text-sm sm:block sm:space-y-2">
                    @foreach ($websiteNav ?? [] as $item)
                        <a href="{{ $item['url'] ?? '#' }}" class="block hover:text-white">{{ $item['label'] ?? '' }}</a>
                    @endforeach
                </div>
            </div>
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-pondok-100/70">Kontak</p>
                <div class="mt-3 space-y-2 text-sm text-pondok-100/85">
                    @if (!empty($settings['email']))
                        <a href="mailto:{{ $settings['email'] }}" class="block break-words-safe hover:text-white">{{ $settings['email'] }}</a>
                    @endif
                    @if (!empty($settings['phone']))
                        <a href="tel:{{ $settings['phone'] }}" class="block break-words-safe hover:text-white">{{ $settings['phone'] }}</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="border-t border-white/10">
            <div class="mx-auto flex max-w-6xl flex-col gap-4 px-4 py-5 text-sm text-pondok-100/70 sm:flex-row sm:items-center sm:justify-between">
                <p>{{ $settings['footer_text'] ?? ('© '.date('Y').' '.($settings['site_name'] ?? 'Pondok Pesantren')) }}</p>
                <div class="flex gap-3">
                    @if (!empty($settings['facebook']))
                        <a href="{{ $settings['facebook'] }}" class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-white/20 hover:bg-white/10" target="_blank" rel="noopener" aria-label="Facebook">f</a>
                    @endif
                    @if (!empty($settings['instagram']))
                        <a href="{{ $settings['instagram'] }}" class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-white/20 hover:bg-white/10" target="_blank" rel="noopener" aria-label="Instagram">ig</a>
                    @endif
                    @if (!empty($settings['youtube']))
                        <a href="{{ $settings['youtube'] }}" class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-white/20 hover:bg-white/10" target="_blank" rel="noopener" aria-label="YouTube">yt</a>
                    @endif
                </div>
            </div>
        </div>
    </footer>
    <x-toast />
    @livewireScripts
</body>
</html>
