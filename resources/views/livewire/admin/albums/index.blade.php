<div>
    <x-admin.page-header title="Galeri Album">
        <x-slot:action>
            <a href="{{ route('admin.albums.create') }}" class="rounded bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">Tambah Album</a>
        </x-slot:action>
    </x-admin.page-header>

    <div class="mb-4">
        <input
            type="search"
            wire:model.live.debounce.300ms="search"
            placeholder="Cari album..."
            class="w-full max-w-md rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500"
        >
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-600">
                <tr>
                    <th class="cursor-pointer px-4 py-3 font-medium" wire:click="sortBy('title')">Judul</th>
                    <th class="px-4 py-3 font-medium">Foto</th>
                    <th class="cursor-pointer px-4 py-3 font-medium" wire:click="sortBy('created_at')">Dibuat</th>
                    <th class="px-4 py-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($albums as $item)
                    <tr>
                        <td class="px-4 py-3 font-medium text-slate-900">{{ $item->title }}</td>
                        <td class="px-4 py-3 text-slate-500">{{ $item->media_count }}</td>
                        <td class="px-4 py-3 text-slate-500">{{ $item->created_at?->format('d/m/Y') }}</td>
                        <td class="space-x-2 px-4 py-3 text-right">
                            <a href="{{ route('admin.albums.edit', $item) }}" class="text-slate-700 underline hover:text-slate-900">Edit</a>
                            <button
                                type="button"
                                wire:click="delete({{ $item->id }})"
                                wire:confirm="Hapus album beserta fotonya?"
                                class="text-rose-600 underline hover:text-rose-800"
                            >Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-slate-500">Belum ada album.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $albums->links() }}</div>
</div>
