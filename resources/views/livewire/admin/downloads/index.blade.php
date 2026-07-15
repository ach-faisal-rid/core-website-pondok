<div>
    <x-admin.page-header
        title="Unduhan"
        description="Kelola file yang dapat diunduh pengunjung dari website, seperti brosur atau formulir."
    >
        <x-slot:action>
            <a href="{{ route('admin.downloads.create') }}" class="admin-btn-primary">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5"/></svg>
                Tambah File
            </a>
        </x-slot:action>
    </x-admin.page-header>

    <div class="mb-4">
        <input
            type="search"
            wire:model.live.debounce.300ms="search"
            placeholder="Cari file unduhan..."
            class="admin-input max-w-md"
        >
    </div>

    @if ($downloads->total() === 0 && blank($search))
        <x-admin.empty-state
            title="Belum ada file unduhan"
            description="Unggah file pertama agar pengunjung bisa mengunduhnya dari website."
            :action-href="route('admin.downloads.create')"
            action-label="Tambah File"
        />
    @else
        <div class="admin-table-wrap">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[var(--pondok-line)] text-sm">
                    <thead class="bg-pondok-50 text-left text-stone-600">
                        <tr>
                            <th class="cursor-pointer px-4 py-3 font-semibold" wire:click="sortBy('title')">Judul</th>
                            <th class="px-4 py-3 font-semibold">Kategori</th>
                            <th class="cursor-pointer px-4 py-3 font-semibold" wire:click="sortBy('file_size')">Ukuran</th>
                            <th class="cursor-pointer px-4 py-3 font-semibold" wire:click="sortBy('download_count')">Diunduh</th>
                            <th class="px-4 py-3 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--pondok-line)]">
                        @forelse ($downloads as $item)
                            <tr class="hover:bg-pondok-50/40">
                                <td class="px-4 py-3 font-medium text-pondok-900">{{ $item->title }}</td>
                                <td class="px-4 py-3 text-stone-500">{{ $item->category ?? '—' }}</td>
                                <td class="px-4 py-3 text-stone-500">{{ number_format($item->file_size / 1024, 1) }} KB</td>
                                <td class="px-4 py-3 text-stone-500">{{ $item->download_count }}</td>
                                <td class="space-x-3 px-4 py-3 text-right">
                                    <a href="{{ route('admin.downloads.edit', $item) }}" class="font-semibold text-pondok-800 hover:underline">Edit</a>
                                    <button
                                        type="button"
                                        wire:click="delete({{ $item->id }})"
                                        wire:confirm="Hapus file ini?"
                                        class="font-semibold text-rose-600 hover:underline"
                                    >Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-stone-500">Tidak ada file yang cocok dengan pencarian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">{{ $downloads->links() }}</div>
    @endif
</div>
