<div>
    <x-admin.page-header title="Kelola Bantuan">
        <x-slot:action>
            <a href="{{ route('admin.help.create') }}" class="admin-btn-primary">Tambah Item</a>
        </x-slot:action>
    </x-admin.page-header>

    <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center">
        <input
            type="search"
            wire:model.live.debounce.300ms="search"
            placeholder="Cari judul atau isi..."
            class="w-full max-w-md rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500"
        >
        <select wire:model.live="categoryFilter" class="w-full max-w-xs rounded border-slate-300 text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500">
            <option value="">Semua kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->value }}">{{ $category->label() }}</option>
            @endforeach
        </select>
        <a href="{{ route('admin.help.index') }}" class="text-sm text-slate-600 underline hover:text-slate-900">Kembali ke Bantuan</a>
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-600">
                <tr>
                    <th class="cursor-pointer px-4 py-3 font-medium" wire:click="sortBy('title')">Judul</th>
                    <th class="px-4 py-3 font-medium">Kategori</th>
                    <th class="cursor-pointer px-4 py-3 font-medium" wire:click="sortBy('sort_order')">Urutan</th>
                    <th class="cursor-pointer px-4 py-3 font-medium" wire:click="sortBy('is_published')">Status</th>
                    <th class="px-4 py-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($articles as $item)
                    <tr>
                        <td class="px-4 py-3 font-medium text-slate-900">{{ $item->title }}</td>
                        <td class="px-4 py-3 text-slate-500">{{ $item->category->label() }}</td>
                        <td class="px-4 py-3 text-slate-500">{{ $item->sort_order }}</td>
                        <td class="px-4 py-3">
                            <span @class([
                                'rounded px-2 py-0.5 text-xs font-medium',
                                'bg-emerald-50 text-emerald-700' => $item->is_published,
                                'bg-slate-100 text-slate-600' => ! $item->is_published,
                            ])>{{ $item->is_published ? 'Dipublikasikan' : 'Draft' }}</span>
                        </td>
                        <td class="space-x-2 px-4 py-3 text-right">
                            <a href="{{ route('admin.help.edit', $item) }}" class="text-slate-700 underline hover:text-slate-900">Edit</a>
                            <button
                                type="button"
                                wire:click="delete({{ $item->id }})"
                                wire:confirm="Hapus item bantuan ini?"
                                class="text-rose-600 underline hover:text-rose-800"
                            >Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-500">Belum ada item bantuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $articles->links() }}</div>
</div>
