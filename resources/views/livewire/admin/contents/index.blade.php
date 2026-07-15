<div>
    <x-admin.page-header
        title="Halaman"
        description="Kelola halaman profil pondok seperti sejarah, identitas, atau halaman statis lainnya."
    >
        <x-slot:action>
            <a href="{{ route('admin.contents.create') }}" class="admin-btn-primary">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5"/></svg>
                Tambah Halaman
            </a>
        </x-slot:action>
    </x-admin.page-header>

    <div class="mb-4">
        <input
            type="search"
            wire:model.live.debounce.300ms="search"
            placeholder="Cari halaman..."
            class="admin-input max-w-md"
        >
    </div>

    @if ($contents->total() === 0 && blank($search))
        <x-admin.empty-state
            title="Belum ada halaman"
            description="Buat halaman pertama, misalnya sejarah atau identitas pondok."
            :action-href="route('admin.contents.create')"
            action-label="Tambah Halaman"
        />
    @else
        <div class="admin-table-wrap">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[var(--pondok-line)] text-sm">
                    <thead class="bg-pondok-50 text-left text-stone-600">
                        <tr>
                            <th class="cursor-pointer px-4 py-3 font-semibold" wire:click="sortBy('title')">Judul</th>
                            <th class="cursor-pointer px-4 py-3 font-semibold" wire:click="sortBy('status')">Status</th>
                            <th class="cursor-pointer px-4 py-3 font-semibold" wire:click="sortBy('created_at')">Dibuat</th>
                            <th class="px-4 py-3 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--pondok-line)]">
                        @forelse ($contents as $item)
                            <tr class="hover:bg-pondok-50/40">
                                <td class="px-4 py-3 font-medium text-pondok-900">{{ $item->title }}</td>
                                <td class="px-4 py-3">
                                    <span @class([
                                        'admin-badge',
                                        'bg-emerald-50 text-emerald-700' => $item->status === App\Enums\PublishStatus::Published,
                                        'bg-stone-100 text-stone-600' => $item->status !== App\Enums\PublishStatus::Published,
                                    ])>{{ $item->status->label() }}</span>
                                </td>
                                <td class="px-4 py-3 text-stone-500">{{ $item->created_at?->format('d/m/Y') }}</td>
                                <td class="space-x-3 px-4 py-3 text-right">
                                    <a href="{{ route('admin.contents.edit', $item) }}" class="font-semibold text-pondok-800 hover:underline">Edit</a>
                                    <button
                                        type="button"
                                        wire:click="delete({{ $item->id }})"
                                        wire:confirm="Hapus halaman ini?"
                                        class="font-semibold text-rose-600 hover:underline"
                                    >Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-10 text-center text-stone-500">Tidak ada halaman yang cocok dengan pencarian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">{{ $contents->links() }}</div>
    @endif
</div>
