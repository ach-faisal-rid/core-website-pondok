<div>
    <x-admin.page-header
        title="Pesan Kontak"
        description="Kelola pesan masuk dari formulir kontak website. Tandai, baca, dan hapus pesan sesuai kebutuhan."
    >
        <x-slot:action>
            <button type="button" wire:click="$refresh" class="admin-btn-primary">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 12a8 8 0 0 1 14.3-4.9M20 12a8 8 0 0 1-14.3 4.9M4.5 4.5v5h5M19.5 19.5v-5h-5"/></svg>
                Segarkan
            </button>
        </x-slot:action>
    </x-admin.page-header>

    <div class="mb-5 grid items-end gap-4 lg:grid-cols-[1fr_auto_auto]">
        <div>
            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-stone-500">Cari pesan</label>
            <div class="relative">
                <input
                    type="search"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Nama, email, subjek, atau isi pesan..."
                    class="admin-input pl-10"
                >
                <span class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center text-stone-400">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14Z"/></svg>
                </span>
            </div>
        </div>

        <div>
            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-stone-500">Status</label>
            <select wire:model.live="statusFilter" class="admin-input min-w-[11rem]">
                <option value="">Semua Status</option>
                <option value="unread">Belum Dibaca</option>
                <option value="read">Sudah Dibaca</option>
            </select>
        </div>

        <div class="flex h-[42px] min-w-[11rem] items-center justify-between gap-3 rounded-lg bg-pondok-900 px-4 text-white lg:min-w-[13rem]">
            <div class="min-w-0">
                <p class="text-[10px] font-semibold uppercase tracking-[0.14em] text-pondok-100/80">Pesan baru</p>
                <p class="text-2xl font-semibold leading-none tabular-nums">{{ $unreadCount }}</p>
            </div>
            <svg class="h-8 w-8 shrink-0 text-white/20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.4" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7.5A1.5 1.5 0 0 1 5.5 6h13A1.5 1.5 0 0 1 20 7.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 16.5v-9Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m5 8 7 5 7-5"/></svg>
        </div>
    </div>

    @if ($messages->total() === 0 && blank($search) && blank($statusFilter))
        <x-admin.empty-state
            title="Belum ada pesan"
            description="Pesan dari formulir kontak website akan muncul di sini."
        >
            <x-slot:icon>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7.5A1.5 1.5 0 0 1 5.5 6h13A1.5 1.5 0 0 1 20 7.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 16.5v-9Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m5 8 7 5 7-5"/></svg>
            </x-slot:icon>
        </x-admin.empty-state>
    @else
        <div class="admin-table-wrap">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[var(--pondok-line)] text-sm">
                    <thead class="bg-pondok-50/80 text-left text-xs font-semibold uppercase tracking-wider text-stone-500">
                        <tr>
                            <th class="cursor-pointer px-4 py-3.5 font-semibold" wire:click="sortBy('name')">Pengirim</th>
                            <th class="px-4 py-3.5 font-semibold">Subjek &amp; Cuplikan</th>
                            <th class="cursor-pointer px-4 py-3.5 font-semibold" wire:click="sortBy('is_read')">Status</th>
                            <th class="cursor-pointer px-4 py-3.5 font-semibold" wire:click="sortBy('created_at')">Tanggal</th>
                            <th class="px-4 py-3.5 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--pondok-line)]">
                        @forelse ($messages as $item)
                            <tr @class(['bg-pondok-50/40' => ! $item->is_read, 'hover:bg-stone-50' => true])>
                                <td class="px-4 py-4">
                                    <div class="font-semibold text-pondok-900">{{ $item->name }}</div>
                                    <div class="mt-0.5 text-xs text-stone-500">{{ $item->email }}</div>
                                </td>
                                <td class="max-w-md px-4 py-4">
                                    <div class="font-medium text-stone-800">{{ $item->subject ?: 'Tanpa subjek' }}</div>
                                    <div class="mt-1 line-clamp-1 text-xs text-stone-500">{{ \Illuminate\Support\Str::limit(strip_tags($item->message), 90) }}</div>
                                </td>
                                <td class="px-4 py-4">
                                    @if ($item->is_read)
                                        <span class="admin-badge bg-stone-100 text-stone-600">Sudah Dibaca</span>
                                    @else
                                        <span class="admin-badge bg-pondok-100 text-pondok-800">Belum Dibaca</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-stone-500">
                                    {{ $item->created_at?->translatedFormat('d M Y') }}
                                    <div class="text-xs">{{ $item->created_at?->format('H:i') }}</div>
                                </td>
                                <td class="space-x-2 whitespace-nowrap px-4 py-4 text-right">
                                    <a href="{{ route('admin.contacts.show', $item) }}" class="font-semibold text-pondok-800 hover:underline">Lihat</a>
                                    @unless ($item->is_read)
                                        <button type="button" wire:click="markRead({{ $item->id }})" class="font-semibold text-stone-600 hover:underline">Tandai dibaca</button>
                                    @endunless
                                    <button
                                        type="button"
                                        wire:click="delete({{ $item->id }})"
                                        wire:confirm="Hapus pesan ini?"
                                        class="font-semibold text-rose-600 hover:underline"
                                    >Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-stone-500">Tidak ada pesan yang cocok dengan filter.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-stone-500">
                Menampilkan {{ $messages->firstItem() ?? 0 }}-{{ $messages->lastItem() ?? 0 }} dari {{ $messages->total() }} pesan.
            </p>
            <div>{{ $messages->links() }}</div>
        </div>
    @endif
</div>
