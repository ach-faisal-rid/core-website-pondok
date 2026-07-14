<div>
    <x-admin.page-header
        title="Dashboard"
        description="Ringkasan data CMS pondok dan aktivitas konten terbaru."
    />

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
        <a href="{{ route('admin.contents.index') }}" class="group rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-[0_1px_2px_rgba(15,58,45,0.04)] transition hover:border-pondok-700/30 hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-stone-500">Konten</span>
                <span class="rounded-lg bg-pondok-50 p-2 text-pondok-800 group-hover:bg-pondok-100">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M7 3.5h7l3 3V20a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4.5a1 1 0 0 1 1-1Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M14 3.5V7h3"/></svg>
                </span>
            </div>
            <div class="mt-4 font-display text-4xl font-semibold tracking-wide text-pondok-900">{{ $contentsCount }}</div>
        </a>

        <a href="{{ route('admin.articles.index') }}" class="group rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-[0_1px_2px_rgba(15,58,45,0.04)] transition hover:border-pondok-700/30 hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-stone-500">Artikel</span>
                <span class="rounded-lg bg-pondok-50 p-2 text-pondok-800 group-hover:bg-pondok-100">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6 4h10a1 1 0 0 1 1 1v15l-6-3-6 3V5a1 1 0 0 1 1-1Z"/></svg>
                </span>
            </div>
            <div class="mt-4 font-display text-4xl font-semibold tracking-wide text-pondok-900">{{ $articlesCount }}</div>
        </a>

        <a href="{{ route('admin.albums.index') }}" class="group rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-[0_1px_2px_rgba(15,58,45,0.04)] transition hover:border-pondok-700/30 hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-stone-500">Album</span>
                <span class="rounded-lg bg-pondok-50 p-2 text-pondok-800 group-hover:bg-pondok-100">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7Z"/><circle cx="9" cy="9" r="1.2"/></svg>
                </span>
            </div>
            <div class="mt-4 font-display text-4xl font-semibold tracking-wide text-pondok-900">{{ $albumsCount }}</div>
        </a>

        <a href="{{ route('admin.downloads.index') }}" class="group rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-[0_1px_2px_rgba(15,58,45,0.04)] transition hover:border-pondok-700/30 hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-stone-500">Download</span>
                <span class="rounded-lg bg-pondok-50 p-2 text-pondok-800 group-hover:bg-pondok-100">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v12m0 0 4-4m-4 4-4-4M5 19h14"/></svg>
                </span>
            </div>
            <div class="mt-4 font-display text-4xl font-semibold tracking-wide text-pondok-900">{{ $downloadsCount }}</div>
        </a>

        <a href="{{ route('admin.contacts.index') }}" class="group rounded-xl border border-[var(--pondok-line)] bg-pondok-900 p-5 text-white shadow-[0_1px_2px_rgba(15,58,45,0.04)] transition hover:bg-pondok-800">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-pondok-100/80">Pesan baru</span>
                <span class="rounded-lg bg-white/10 p-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7.5A1.5 1.5 0 0 1 5.5 6h13A1.5 1.5 0 0 1 20 7.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 16.5v-9Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m5 8 7 5 7-5"/></svg>
                </span>
            </div>
            <div class="mt-4 font-display text-4xl font-semibold tracking-wide">{{ $unreadContactsCount }}</div>
        </a>
    </div>
</div>
