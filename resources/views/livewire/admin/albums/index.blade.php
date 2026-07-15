<div>
    <x-admin.page-header
        title="Galeri"
        description="Kelola album foto kegiatan pondok yang ditampilkan di halaman Galeri."
    >
        <x-slot:action>
            <a href="{{ route('admin.albums.create') }}" class="admin-btn-primary">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5"/></svg>
                Tambah Album
            </a>
        </x-slot:action>
    </x-admin.page-header>

    <div class="mb-4">
        <input
            type="search"
            wire:model.live.debounce.300ms="search"
            placeholder="Cari album..."
            class="admin-input max-w-md"
        >
    </div>

    @if ($albums->total() === 0 && blank($search))
        <x-admin.empty-state
            title="Belum ada album"
            description="Buat album pertama untuk mengunggah dan menampilkan foto kegiatan pondok."
            :action-href="route('admin.albums.create')"
            action-label="Tambah Album"
        />
    @else
        <div class="admin-table-wrap">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[var(--pondok-line)] text-sm">
                    <thead class="bg-pondok-50 text-left text-stone-600">
                        <tr>
                            <th class="cursor-pointer px-4 py-3 font-semibold" wire:click="sortBy('title')">Judul</th>
                            <th class="px-4 py-3 font-semibold">Foto</th>
                            <th class="cursor-pointer px-4 py-3 font-semibold" wire:click="sortBy('created_at')">Dibuat</th>
                            <th class="px-4 py-3 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--pondok-line)]">
                        @forelse ($albums as $item)
                            <tr class="hover:bg-pondok-50/40">
                                <td class="px-4 py-3 font-medium text-pondok-900">{{ $item->title }}</td>
                                <td class="px-4 py-3 text-stone-500">{{ $item->media_count }}</td>
                                <td class="px-4 py-3 text-stone-500">{{ $item->created_at?->format('d/m/Y') }}</td>
                                <td class="space-x-3 px-4 py-3 text-right">
                                    <a href="{{ route('admin.albums.edit', $item) }}" class="font-semibold text-pondok-800 hover:underline">Edit</a>
                                    <button
                                        type="button"
                                        wire:click="delete({{ $item->id }})"
                                        wire:confirm="Hapus album beserta fotonya?"
                                        class="font-semibold text-rose-600 hover:underline"
                                    >Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-10 text-center text-stone-500">Tidak ada album yang cocok dengan pencarian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">{{ $albums->links() }}</div>
    @endif
</div>
