<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} &mdash; {{ $settings['site_name'] ?? config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:500,600,700|plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="font-sans antialiased bg-[var(--pondok-surface)] text-stone-800" x-data="{ sidebarOpen: false }">
    @php
        $crumbGroup = match (true) {
            request()->routeIs('admin.dashboard') => null,
            request()->routeIs('admin.website.*') => 'Website',
            request()->routeIs('admin.articles.*', 'admin.albums.*', 'admin.downloads.*', 'admin.contents.*') => 'Publikasi',
            request()->routeIs('admin.contacts.*') => 'Komunikasi',
            request()->routeIs('admin.users.*', 'admin.help.*') => 'Sistem',
            default => null,
        };
        $roleLabel = auth()->user()->role?->label() ?? 'Operator';
    @endphp

    <div class="min-h-screen lg:flex">
        <div
            class="fixed inset-0 z-30 bg-pondok-950/40 lg:hidden"
            x-show="sidebarOpen"
            x-transition.opacity
            @click="sidebarOpen = false"
            style="display: none;"
        ></div>

        <aside
            class="fixed inset-y-0 left-0 z-40 flex w-64 transform flex-col border-r border-[var(--pondok-line)] bg-white transition lg:static lg:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <div class="flex h-16 items-center border-b border-[var(--pondok-line)] px-5">
                <a href="{{ route('admin.dashboard') }}" class="truncate font-display text-xl font-semibold tracking-wide text-pondok-900">
                    {{ $settings['site_name'] ?? 'Pesantren Digital' }}
                </a>
            </div>

            <nav class="flex-1 space-y-5 overflow-y-auto px-3 py-5 text-sm">
                <div class="space-y-0.5">
                    <a href="{{ route('admin.dashboard') }}" @class(['admin-nav-link', 'admin-nav-link-active' => request()->routeIs('admin.dashboard')])>
                        <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h7v7H4V4Zm9 0h7v5h-7V4ZM4 13h7v7H4v-7Zm9 3h7v4h-7v-4Z"/></svg>
                        Dashboard
                    </a>
                </div>

                @can('viewAny', App\Models\Setting::class)
                    <div x-data="{ open: {{ request()->routeIs('admin.website.*') ? 'true' : 'false' }} }">
                        <p class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-[0.14em] text-stone-400">Website</p>
                        <button
                            type="button"
                            @click="open = !open"
                            class="admin-nav-link w-full"
                            :class="open && 'bg-pondok-50 text-pondok-900'"
                        >
                            <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3 4 7.5v9L12 21l8-4.5v-9L12 3Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 12 4 7.5M12 12l8-4.5M12 12v9"/></svg>
                            <span class="min-w-0 flex-1 text-left">Kelola Website</span>
                            <svg class="ms-auto h-3.5 w-3.5 shrink-0 text-stone-400 transition-transform duration-150" width="14" height="14" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6"/></svg>
                        </button>
                        <div x-show="open" x-cloak class="mt-0.5 space-y-0.5 border-l border-[var(--pondok-line)] ms-5 ps-2">
                            @foreach ([
                                'hero' => 'Hero',
                                'tentang' => 'Tentang Pondok',
                                'pengasuh' => 'Pengasuh',
                                'visi-misi' => 'Visi & Misi',
                                'panca-jiwa' => 'Panca Jiwa',
                                'struktur' => 'Struktur Organisasi',
                                'statistik' => 'Statistik',
                                'navigasi' => 'Navigasi',
                                'footer' => 'Footer',
                                'seo' => 'SEO',
                                'tema' => 'Tema',
                            ] as $route => $label)
                                <a
                                    href="{{ route('admin.website.'.$route) }}"
                                    @class([
                                        'admin-nav-link admin-nav-sub',
                                        'admin-nav-link-active' => request()->routeIs('admin.website.'.$route),
                                    ])
                                >{{ $label }}</a>
                            @endforeach
                        </div>
                    </div>
                @endcan

                <div>
                    <p class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-[0.14em] text-stone-400">Publikasi</p>
                    <div class="space-y-0.5">
                        <a href="{{ route('admin.articles.index') }}" @class(['admin-nav-link', 'admin-nav-link-active' => request()->routeIs('admin.articles.*')])>
                            <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6 4h10a1 1 0 0 1 1 1v15l-6-3-6 3V5a1 1 0 0 1 1-1Z"/></svg>
                            Artikel
                        </a>
                        <a href="{{ route('admin.albums.index') }}" @class(['admin-nav-link', 'admin-nav-link-active' => request()->routeIs('admin.albums.*')])>
                            <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m8 14 2.5-2.5L14 15l2-2 2 2"/><circle cx="9" cy="9" r="1.2"/></svg>
                            Galeri
                        </a>
                        <a href="{{ route('admin.downloads.index') }}" @class(['admin-nav-link', 'admin-nav-link-active' => request()->routeIs('admin.downloads.*')])>
                            <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v12m0 0 4-4m-4 4-4-4M5 19h14"/></svg>
                            Unduhan
                        </a>
                        <a href="{{ route('admin.contents.index') }}" @class(['admin-nav-link', 'admin-nav-link-active' => request()->routeIs('admin.contents.*')])>
                            <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M7 3.5h7l3 3V20a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4.5a1 1 0 0 1 1-1Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M14 3.5V7h3M9 11h6M9 15h4"/></svg>
                            Halaman
                        </a>
                    </div>
                </div>

                <div>
                    <p class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-[0.14em] text-stone-400">Komunikasi</p>
                    <div class="space-y-0.5">
                        <a href="{{ route('admin.contacts.index') }}" @class(['admin-nav-link', 'admin-nav-link-active' => request()->routeIs('admin.contacts.*')])>
                            <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7.5A1.5 1.5 0 0 1 5.5 6h13A1.5 1.5 0 0 1 20 7.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 16.5v-9Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m5 8 7 5 7-5"/></svg>
                            Pesan Kontak
                            @if (($unreadContactsCount ?? 0) > 0)
                                <span class="ms-auto rounded-full bg-pondok-800 px-2 py-0.5 text-[10px] font-bold text-white">{{ $unreadContactsCount }}</span>
                            @endif
                        </a>
                    </div>
                </div>

                <div>
                    <p class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-[0.14em] text-stone-400">Sistem</p>
                    <div class="space-y-0.5">
                        @can('viewAny', App\Models\User::class)
                            <a href="{{ route('admin.users.index') }}" @class(['admin-nav-link', 'admin-nav-link-active' => request()->routeIs('admin.users.*')])>
                                <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16 19v-1a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v1"/><circle cx="9.5" cy="7.5" r="3"/><path stroke-linecap="round" stroke-linejoin="round" d="M20 19v-1a3.5 3.5 0 0 0-2.5-3.3"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 4.6a3 3 0 0 1 0 5.8"/></svg>
                                Pengguna
                            </a>
                        @endcan
                        <a href="{{ route('admin.help.index') }}" @class(['admin-nav-link', 'admin-nav-link-active' => request()->routeIs('admin.help.*')])>
                            <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 17h.01M9.2 9.2a2.8 2.8 0 1 1 4.4 2.3c-.8.5-1.6 1.1-1.6 2v.5"/><circle cx="12" cy="12" r="9"/></svg>
                            Bantuan
                        </a>
                    </div>
                </div>

                <div class="border-t border-[var(--pondok-line)] pt-4">
                    <a href="{{ route('home') }}" target="_blank" class="admin-nav-link">
                        <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M14 4h6v6M10 14 20 4M18 13v5a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h5"/></svg>
                        Lihat Website
                    </a>
                </div>
            </nav>

            <div class="border-t border-[var(--pondok-line)] p-3">
                <div class="flex items-center gap-3 rounded-xl bg-pondok-50 px-3 py-3">
                    <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-pondok-800 text-sm font-semibold text-white">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-semibold text-pondok-900">{{ auth()->user()->name }}</p>
                        <p class="truncate text-xs font-medium text-pondok-800/80">{{ $roleLabel }}</p>
                        <p class="truncate text-[11px] text-stone-500" title="{{ auth()->user()->email }}">{{ auth()->user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                        @csrf
                        <button type="submit" class="rounded-lg p-2 text-stone-500 hover:bg-white hover:text-pondok-800" title="Keluar" aria-label="Keluar">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12H4m0 0 3-3m-3 3 3 3m6-9h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex min-h-screen min-w-0 flex-1 flex-col">
            <header class="sticky top-0 z-20 flex h-16 items-center gap-3 border-b border-[var(--pondok-line)] bg-white/95 px-4 backdrop-blur sm:gap-4 lg:px-6">
                <button type="button" class="admin-btn-secondary !px-3 !py-2 lg:hidden" @click="sidebarOpen = !sidebarOpen" aria-label="Menu">
                    Menu
                </button>

                <nav class="hidden min-w-0 items-center gap-1.5 text-sm text-stone-500 sm:flex" aria-label="Breadcrumb">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-pondok-800">Dashboard</a>
                    @if ($crumbGroup)
                        <span class="text-stone-300" aria-hidden="true">&rsaquo;</span>
                        <span>{{ $crumbGroup }}</span>
                    @endif
                    <span class="text-stone-300" aria-hidden="true">&rsaquo;</span>
                    <span class="truncate font-medium text-pondok-900">{{ $title ?? 'Dashboard' }}</span>
                </nav>

                <div class="ms-auto flex items-center gap-2 sm:gap-3">
                    <div class="relative hidden md:block">
                        <input type="search" placeholder="Pencarian..." class="admin-input w-56 pl-9 lg:w-72" disabled title="Pencarian global segera hadir">
                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-stone-400">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14Z"/></svg>
                        </span>
                    </div>
                    <a href="{{ route('admin.contacts.index') }}" class="relative rounded-lg border border-[var(--pondok-line)] p-2.5 text-stone-600 hover:bg-pondok-50 hover:text-pondok-900" aria-label="Notifikasi pesan">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.4-1.4A2 2 0 0 1 18 14.2V11a6 6 0 1 0-12 0v3.2a2 2 0 0 1-.6 1.4L4 17h5m6 0a3 3 0 1 1-6 0"/></svg>
                        @if (($unreadContactsCount ?? 0) > 0)
                            <span class="absolute right-1.5 top-1.5 h-2 w-2 rounded-full bg-rose-500"></span>
                        @endif
                    </a>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>

            <footer class="border-t border-[var(--pondok-line)] bg-white px-4 py-4 text-xs text-stone-500 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="font-medium text-stone-600">CMS {{ $settings['site_name'] ?? 'Pondok Pesantren Digital' }}</p>
                        <p class="mt-0.5">Versi 1.0.0 &middot; &copy; {{ date('Y') }}</p>
                    </div>
                    <div class="flex gap-4">
                        <a href="{{ route('admin.help.index') }}" class="hover:text-pondok-800">Panduan Admin</a>
                        <a href="{{ route('kontak') }}" class="hover:text-pondok-800" target="_blank">Kontak Dukungan</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <x-toast />
    @livewireScripts
</body>
</html>

