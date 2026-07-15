<div>
    <x-admin.page-header title="Visi & Misi" description="Visi, daftar misi, motto, dan nilai pondok." />
    <form wire:submit="save" class="max-w-3xl space-y-4 rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm sm:p-6">
        <div>
            <label class="pondok-label">Visi</label>
            <textarea wire:model="profil_visi" rows="4" class="pondok-input"></textarea>
            @error('profil_visi') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <div class="mb-2 flex items-center justify-between">
                <label class="pondok-label mb-0">Misi</label>
                <button type="button" wire:click="addMisi" class="text-sm font-semibold text-pondok-800 hover:underline">+ Tambah</button>
            </div>
            <div class="space-y-2">
                @foreach ($misi as $index => $item)
                    <div class="flex gap-2">
                        <input type="text" wire:model="misi.{{ $index }}" class="pondok-input" placeholder="Poin misi">
                        <button type="button" wire:click="removeMisi({{ $index }})" class="shrink-0 px-2 text-sm text-rose-600 hover:underline">Hapus</button>
                    </div>
                @endforeach
            </div>
        </div>
        <div>
            <label class="pondok-label">Motto</label>
            <input type="text" wire:model="profil_motto" class="pondok-input">
        </div>
        <div>
            <label class="pondok-label">Nilai</label>
            <textarea wire:model="profil_nilai" rows="3" class="pondok-input"></textarea>
        </div>
        <button type="submit" class="admin-btn-primary" wire:loading.attr="disabled">Simpan</button>
    </form>
</div>
