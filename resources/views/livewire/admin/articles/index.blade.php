<div>
    <x-admin.page-header
        title="Artikel"
        description="Kelola berita, informasi, dan pengumuman yang akan ditampilkan pada website pondok."
    >
        <x-slot:action>
            <a href="{{ route('admin.articles.create') }}" class="admin-btn-primary">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5"/></svg>
                Tambah Artikel
            </a>
        </x-slot:action>
    </x-admin.page-header>

    <div class="mb-5 grid gap-3 sm:grid-cols-3">
        <div class="admin-stat-card">
            <p class="text-[11px] font-semibold uppercase tracking-[0.14em] text-stone-400">Total Artikel</p>
            <p class="mt-1 font-display text-3xl font-semibold text-pondok-900">{{ $stats['total'] }}</p>
        </div>
        <div class="admin-stat-card">
            <p class="text-[11px] font-semibold uppercase tracking-[0.14em] text-stone-400">Draft</p>
            <p class="mt-1 font-display text-3xl font-semibold text-amber-700">{{ $stats['draft'] }}</p>
        </div>
        <div class="admin-stat-card">
            <p class="text-[11px] font-semibold uppercase tracking-[0.14em] text-stone-400">Terbit</p>
            <p class="mt-1 font-display text-3xl font-semibold text-pondok-800">{{ $stats['published'] }}</p>
        </div>
    </div>

    <div class="mb-4">
        <input
            type="search"
            wire:model.live.debounce.300ms="search"
            placeholder="Cari judul artikel..."
            class="admin-input max-w-md"
        >
    </div>

    @if ($articles->total() === 0 && blank($search))
        <x-admin.empty-state
            title="Belum ada artikel"
            description="Mulailah membuat berita atau informasi pertama untuk website pondok."
            :action-href="route('admin.articles.create')"
            action-label="Tambah Artikel"
        >
            <x-slot:icon>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 4h10a1 1 0 0 1 1 1v15l-6-3-6 3V5a1 1 0 0 1 1-1Z"/></svg>
            </x-slot:icon>
        </x-admin.empty-state>
    @else
        <div class="admin-table-wrap">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[var(--pondok-line)] text-sm">
                    <thead class="bg-pondok-50 text-left text-stone-600">
                        <tr>
                            <th class="cursor-pointer px-4 py-3 font-semibold" wire:click="sortBy('title')">Judul</th>
                            <th class="px-4 py-3 font-semibold">Kategori</th>
                            <th class="px-4 py-3 font-semibold">Penulis</th>
                            <th class="cursor-pointer px-4 py-3 font-semibold" wire:click="sortBy('status')">Status</th>
                            <th class="cursor-pointer px-4 py-3 font-semibold" wire:click="sortBy('published_at')">Tanggal</th>
                            <th class="px-4 py-3 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--pondok-line)]">
                        @forelse ($articles as $item)
                            <tr class="hover:bg-pondok-50/40">
                                <td class="px-4 py-3 font-medium text-pondok-900">{{ $item->title }}</td>
                                <td class="px-4 py-3 text-stone-500">{{ $item->category?->name ?? '—' }}</td>
                                <td class="px-4 py-3 text-stone-500">{{ $item->author?->name ?? '—' }}</td>
                                <td class="px-4 py-3">
                                    <span @class([
                                        'admin-badge',
                                        'bg-emerald-50 text-emerald-700' => $item->status === App\Enums\PublishStatus::Published,
                                        'bg-amber-50 text-amber-700' => $item->status === App\Enums\PublishStatus::Scheduled,
                                        'bg-stone-100 text-stone-600' => $item->status === App\Enums\PublishStatus::Draft,
                                    ])>{{ $item->status->label() }}</span>
                                </td>
                                <td class="px-4 py-3 text-stone-500">{{ $item->published_at?->format('d/m/Y') ?? '—' }}</td>
                                <td class="space-x-3 px-4 py-3 text-right">
                                    <a href="{{ route('admin.articles.edit', $item) }}" class="font-semibold text-pondok-800 hover:underline">Edit</a>
                                    <button
                                        type="button"
                                        wire:click="delete({{ $item->id }})"
                                        wire:confirm="Hapus artikel ini?"
                                        class="font-semibold text-rose-600 hover:underline"
                                    >Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-10 text-center text-stone-500">Tidak ada artikel yang cocok dengan pencarian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">{{ $articles->links() }}</div>
    @endif
</div>
