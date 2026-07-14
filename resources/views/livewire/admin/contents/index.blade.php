<div>
    <x-admin.page-header title="Konten">
        <x-slot:action>
            <a href="{{ route('admin.contents.create') }}" class="admin-btn-primary">Tambah Konten</a>
        </x-slot:action>
    </x-admin.page-header>

    <div class="mb-4">
        <input
            type="search"
            wire:model.live.debounce.300ms="search"
            placeholder="Cari judul atau slug..."
            class="w-full max-w-md rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500"
        >
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-600">
                <tr>
                    <th class="cursor-pointer px-4 py-3 font-medium" wire:click="sortBy('title')">Judul</th>
                    <th class="px-4 py-3 font-medium">Slug</th>
                    <th class="cursor-pointer px-4 py-3 font-medium" wire:click="sortBy('status')">Status</th>
                    <th class="cursor-pointer px-4 py-3 font-medium" wire:click="sortBy('created_at')">Dibuat</th>
                    <th class="px-4 py-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($contents as $item)
                    <tr>
                        <td class="px-4 py-3 font-medium text-slate-900">{{ $item->title }}</td>
                        <td class="px-4 py-3 text-slate-500">{{ $item->slug }}</td>
                        <td class="px-4 py-3">
                            <span @class([
                                'rounded px-2 py-0.5 text-xs font-medium',
                                'bg-emerald-50 text-emerald-700' => $item->status === App\Enums\PublishStatus::Published,
                                'bg-slate-100 text-slate-600' => $item->status !== App\Enums\PublishStatus::Published,
                            ])>{{ $item->status->label() }}</span>
                        </td>
                        <td class="px-4 py-3 text-slate-500">{{ $item->created_at?->format('d/m/Y') }}</td>
                        <td class="space-x-2 px-4 py-3 text-right">
                            <a href="{{ route('admin.contents.edit', $item) }}" class="text-slate-700 underline hover:text-slate-900">Edit</a>
                            <button
                                type="button"
                                wire:click="delete({{ $item->id }})"
                                wire:confirm="Hapus konten ini?"
                                class="text-rose-600 underline hover:text-rose-800"
                            >Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-500">Belum ada konten.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $contents->links() }}</div>
</div>
