<div>
    <x-admin.page-header title="Struktur Organisasi" description="Kelola anggota struktur organisasi sebagai entitas tersendiri." />

    <div class="grid gap-6 lg:grid-cols-5">
        <form wire:submit="save" class="space-y-4 rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm lg:col-span-2">
            <h2 class="font-semibold text-pondok-900">{{ $editingId ? 'Edit anggota' : 'Tambah anggota' }}</h2>
            <div>
                <label class="pondok-label">Nama</label>
                <input type="text" wire:model="name" class="pondok-input">
                @error('name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="pondok-label">Jabatan</label>
                <input type="text" wire:model="title" class="pondok-input">
            </div>
            <div>
                <label class="pondok-label">Urutan</label>
                <input type="number" wire:model="sort_order" min="0" class="pondok-input">
            </div>
            <div>
                <label class="pondok-label">Foto</label>
                <input type="file" wire:model="photo" accept="image/*" class="mt-1.5 w-full text-sm">
                @error('photo') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div class="flex flex-wrap gap-2">
                <button type="submit" class="admin-btn-primary" wire:loading.attr="disabled">
                    {{ $editingId ? 'Perbarui' : 'Tambah' }}
                </button>
                @if ($editingId)
                    <button type="button" wire:click="cancelEdit" class="rounded-lg border border-[var(--pondok-line)] px-4 py-2 text-sm font-semibold text-stone-600 hover:bg-stone-50">Batal</button>
                @endif
            </div>
        </form>

        <div class="lg:col-span-3">
            <div class="overflow-hidden rounded-xl border border-[var(--pondok-line)] bg-white shadow-sm">
                <table class="min-w-full text-sm">
                    <thead class="bg-pondok-50 text-left text-stone-600">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Urutan</th>
                            <th class="px-4 py-3 font-semibold">Nama</th>
                            <th class="px-4 py-3 font-semibold">Jabatan</th>
                            <th class="px-4 py-3 font-semibold"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--pondok-line)]">
                        @forelse ($members as $member)
                            <tr>
                                <td class="px-4 py-3 text-stone-500">{{ $member->sort_order }}</td>
                                <td class="px-4 py-3 font-medium text-pondok-900">{{ $member->name }}</td>
                                <td class="px-4 py-3 text-stone-600">{{ $member->title }}</td>
                                <td class="px-4 py-3 text-end">
                                    <button type="button" wire:click="edit({{ $member->id }})" class="text-pondok-800 hover:underline">Edit</button>
                                    <button type="button" wire:click="delete({{ $member->id }})" wire:confirm="Hapus anggota ini?" class="ms-3 text-rose-600 hover:underline">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-stone-500">Belum ada anggota struktur.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
