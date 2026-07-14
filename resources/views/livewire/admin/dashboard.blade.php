<div>
    <x-admin.page-header title="Dashboard" />

    <p class="mb-6 text-sm text-slate-600">Ringkasan data CMS pondok.</p>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
        <a href="{{ route('admin.contents.index') }}" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm hover:border-slate-300">
            <div class="text-sm text-slate-500">Konten</div>
            <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $contentsCount }}</div>
        </a>
        <a href="{{ route('admin.articles.index') }}" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm hover:border-slate-300">
            <div class="text-sm text-slate-500">Artikel</div>
            <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $articlesCount }}</div>
        </a>
        <a href="{{ route('admin.albums.index') }}" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm hover:border-slate-300">
            <div class="text-sm text-slate-500">Album</div>
            <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $albumsCount }}</div>
        </a>
        <a href="{{ route('admin.downloads.index') }}" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm hover:border-slate-300">
            <div class="text-sm text-slate-500">Download</div>
            <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $downloadsCount }}</div>
        </a>
        <a href="{{ route('admin.contacts.index') }}" class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm hover:border-slate-300">
            <div class="text-sm text-slate-500">Pesan belum dibaca</div>
            <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $unreadContactsCount }}</div>
        </a>
    </div>
</div>
