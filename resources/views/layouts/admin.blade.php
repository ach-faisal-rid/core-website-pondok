<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} — {{ $settings['site_name'] ?? config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-slate-100 text-slate-800" x-data="{ sidebarOpen: false }">
    <div class="min-h-screen lg:flex">
        <aside
            class="fixed inset-y-0 left-0 z-40 w-64 transform bg-slate-900 text-slate-100 transition lg:static lg:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <div class="flex h-16 items-center border-b border-slate-700 px-5 font-semibold tracking-wide">
                {{ $settings['site_name'] ?? 'CMS Pondok' }}
            </div>
            <nav class="space-y-1 p-3 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="block rounded px-3 py-2 hover:bg-slate-800 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800' : '' }}">Dashboard</a>
                @can('viewAny', App\Models\Setting::class)
                    <a href="{{ route('admin.settings') }}" class="block rounded px-3 py-2 hover:bg-slate-800 {{ request()->routeIs('admin.settings') ? 'bg-slate-800' : '' }}">Pengaturan</a>
                @endcan
                <a href="{{ route('admin.contents.index') }}" class="block rounded px-3 py-2 hover:bg-slate-800 {{ request()->routeIs('admin.contents.*') ? 'bg-slate-800' : '' }}">Konten</a>
                <a href="{{ route('admin.articles.index') }}" class="block rounded px-3 py-2 hover:bg-slate-800 {{ request()->routeIs('admin.articles.*') ? 'bg-slate-800' : '' }}">Artikel</a>
                <a href="{{ route('admin.albums.index') }}" class="block rounded px-3 py-2 hover:bg-slate-800 {{ request()->routeIs('admin.albums.*') ? 'bg-slate-800' : '' }}">Galeri</a>
                <a href="{{ route('admin.downloads.index') }}" class="block rounded px-3 py-2 hover:bg-slate-800 {{ request()->routeIs('admin.downloads.*') ? 'bg-slate-800' : '' }}">Download</a>
                <a href="{{ route('admin.contacts.index') }}" class="block rounded px-3 py-2 hover:bg-slate-800 {{ request()->routeIs('admin.contacts.*') ? 'bg-slate-800' : '' }}">Pesan Kontak</a>
                @can('viewAny', App\Models\User::class)
                    <a href="{{ route('admin.users.index') }}" class="block rounded px-3 py-2 hover:bg-slate-800 {{ request()->routeIs('admin.users.*') ? 'bg-slate-800' : '' }}">Pengguna</a>
                @endcan
                <a href="{{ route('admin.help.index') }}" class="block rounded px-3 py-2 hover:bg-slate-800 {{ request()->routeIs('admin.help.*') ? 'bg-slate-800' : '' }}">Bantuan</a>
                <a href="{{ route('home') }}" class="block rounded px-3 py-2 hover:bg-slate-800" target="_blank">Lihat Website</a>
            </nav>
        </aside>

        <div class="flex min-h-screen flex-1 flex-col lg:ml-0">
            <header class="flex h-16 items-center justify-between border-b border-slate-200 bg-white px-4 lg:px-6">
                <button type="button" class="rounded border border-slate-300 px-3 py-1 text-sm lg:hidden" @click="sidebarOpen = !sidebarOpen">Menu</button>
                <div class="text-sm text-slate-500">{{ $title ?? 'Admin' }}</div>
                <div class="flex items-center gap-3 text-sm">
                    <span>{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded bg-slate-800 px-3 py-1.5 text-white hover:bg-slate-700">Logout</button>
                    </form>
                </div>
            </header>

            <main class="flex-1 p-4 lg:p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
    <x-toast />
    @livewireScripts
</body>
</html>
