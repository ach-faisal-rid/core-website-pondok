<div>
    <x-admin.page-header title="Artikel">
        <x-slot:action>
            <a href="{{ route('admin.articles.create') }}" class="rounded bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">Tambah Artikel</a>
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
                    <th class="px-4 py-3 font-medium">Tipe</th>
                    <th class="px-4 py-3 font-medium">Kategori</th>
                    <th class="cursor-pointer px-4 py-3 font-medium" wire:click="sortBy('status')">Status</th>
                    <th class="cursor-pointer px-4 py-3 font-medium" wire:click="sortBy('published_at')">Terbit</th>
                    <th class="px-4 py-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($articles as $item)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="font-medium text-slate-900">{{ $item->title }}</div>
                            <div class="text-xs text-slate-500">{{ $item->author?->name }}</div>
                        </td>
                        <td class="px-4 py-3">{{ $item->type->label() }}</td>
                        <td class="px-4 py-3 text-slate-500">{{ $item->category?->name ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <span @class([
                                'rounded px-2 py-0.5 text-xs font-medium',
                                'bg-emerald-50 text-emerald-700' => $item->status === App\Enums\PublishStatus::Published,
                                'bg-amber-50 text-amber-700' => $item->status === App\Enums\PublishStatus::Scheduled,
                                'bg-slate-100 text-slate-600' => $item->status === App\Enums\PublishStatus::Draft,
                            ])>{{ $item->status->label() }}</span>
                        </td>
                        <td class="px-4 py-3 text-slate-500">{{ $item->published_at?->format('d/m/Y H:i') ?? '—' }}</td>
                        <td class="space-x-2 px-4 py-3 text-right">
                            <a href="{{ route('admin.articles.edit', $item) }}" class="text-slate-700 underline hover:text-slate-900">Edit</a>
                            <button
                                type="button"
                                wire:click="delete({{ $item->id }})"
                                wire:confirm="Hapus artikel ini?"
                                class="text-rose-600 underline hover:text-rose-800"
                            >Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-slate-500">Belum ada artikel.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $articles->links() }}</div>
</div>
