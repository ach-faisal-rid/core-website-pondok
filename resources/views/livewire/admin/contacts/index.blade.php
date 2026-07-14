<div>
    <x-admin.page-header title="Pesan Kontak" />

    <div class="mb-4">
        <input
            type="search"
            wire:model.live.debounce.300ms="search"
            placeholder="Cari nama, email, atau pesan..."
            class="w-full max-w-md rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500"
        >
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-600">
                <tr>
                    <th class="cursor-pointer px-4 py-3 font-medium" wire:click="sortBy('name')">Pengirim</th>
                    <th class="px-4 py-3 font-medium">Subjek</th>
                    <th class="cursor-pointer px-4 py-3 font-medium" wire:click="sortBy('is_read')">Status</th>
                    <th class="cursor-pointer px-4 py-3 font-medium" wire:click="sortBy('created_at')">Tanggal</th>
                    <th class="px-4 py-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($messages as $item)
                    <tr @class(['bg-sky-50/50' => ! $item->is_read])>
                        <td class="px-4 py-3">
                            <div class="font-medium text-slate-900">{{ $item->name }}</div>
                            <div class="text-xs text-slate-500">{{ $item->email }}</div>
                        </td>
                        <td class="px-4 py-3 text-slate-700">{{ $item->subject ?? '—' }}</td>
                        <td class="px-4 py-3">
                            @if ($item->is_read)
                                <span class="rounded bg-slate-100 px-2 py-0.5 text-xs text-slate-600">Dibaca</span>
                            @else
                                <span class="rounded bg-sky-50 px-2 py-0.5 text-xs font-medium text-sky-700">Baru</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-slate-500">{{ $item->created_at?->format('d/m/Y H:i') }}</td>
                        <td class="space-x-2 px-4 py-3 text-right">
                            <a href="{{ route('admin.contacts.show', $item) }}" class="text-slate-700 underline hover:text-slate-900">Lihat</a>
                            @unless ($item->is_read)
                                <button type="button" wire:click="markRead({{ $item->id }})" class="text-slate-700 underline hover:text-slate-900">Tandai dibaca</button>
                            @endunless
                            <button
                                type="button"
                                wire:click="delete({{ $item->id }})"
                                wire:confirm="Hapus pesan ini?"
                                class="text-rose-600 underline hover:text-rose-800"
                            >Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-500">Belum ada pesan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $messages->links() }}</div>
</div>
