<div>
    <x-admin.page-header
        title="Kelola Bantuan"
        description="Tambah, ubah, atau arsipkan panduan CMS yang dibaca operator di halaman Bantuan."
    >
        <x-slot:action>
            <a href="{{ route('admin.help.index') }}" class="admin-btn-secondary">Lihat Halaman Bantuan</a>
            <a href="{{ route('admin.help.create') }}" class="admin-btn-primary">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5"/></svg>
                Tambah Item
            </a>
        </x-slot:action>
    </x-admin.page-header>

    <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-end">
        <div class="min-w-0 flex-1">
            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-stone-500">Cari</label>
            <input
                type="search"
                wire:model.live.debounce.300ms="search"
                placeholder="Cari judul atau isi panduan..."
                class="admin-input"
            >
        </div>
        <div class="sm:w-56">
            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-stone-500">Kategori</label>
            <select wire:model.live="categoryFilter" class="admin-input">
                <option value="">Semua kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->value }}">{{ $category->label() }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if ($articles->total() === 0 && blank($search) && blank($categoryFilter))
        <x-admin.empty-state
            title="Belum ada item bantuan"
            description="Buat panduan pertama agar operator mudah memahami setiap menu CMS."
            :action-href="route('admin.help.create')"
            action-label="Tambah Item"
        />
    @else
        <div class="admin-table-wrap">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[var(--pondok-line)] text-sm">
                    <thead class="bg-pondok-50 text-left text-stone-600">
                        <tr>
                            <th class="cursor-pointer px-4 py-3 font-semibold" wire:click="sortBy('title')">Judul</th>
                            <th class="px-4 py-3 font-semibold">Kategori</th>
                            <th class="cursor-pointer px-4 py-3 font-semibold" wire:click="sortBy('sort_order')">Urutan</th>
                            <th class="cursor-pointer px-4 py-3 font-semibold" wire:click="sortBy('is_published')">Status</th>
                            <th class="px-4 py-3 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--pondok-line)]">
                        @forelse ($articles as $item)
                            <tr class="hover:bg-pondok-50/40">
                                <td class="px-4 py-3 font-medium text-pondok-900">{{ $item->title }}</td>
                                <td class="px-4 py-3 text-stone-500">{{ $item->category->label() }}</td>
                                <td class="px-4 py-3 text-stone-500">{{ $item->sort_order }}</td>
                                <td class="px-4 py-3">
                                    <span @class([
                                        'admin-badge',
                                        'bg-emerald-50 text-emerald-700' => $item->is_published,
                                        'bg-stone-100 text-stone-600' => ! $item->is_published,
                                    ])>{{ $item->is_published ? 'Ditampilkan' : 'Draft' }}</span>
                                </td>
                                <td class="space-x-3 px-4 py-3 text-right">
                                    <a href="{{ route('admin.help.edit', $item) }}" class="font-semibold text-pondok-800 hover:underline">Edit</a>
                                    <button
                                        type="button"
                                        wire:click="delete({{ $item->id }})"
                                        wire:confirm="Hapus item bantuan ini?"
                                        class="font-semibold text-rose-600 hover:underline"
                                    >Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-stone-500">Tidak ada item yang cocok dengan filter.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">{{ $articles->links() }}</div>
    @endif
</div>
