<div>
    <x-admin.page-header title="Navigasi" description="Menu utama website publik (label + URL)." />
    <form wire:submit="save" class="space-y-6">
        <div class="flex items-center justify-between">
            <p class="text-sm text-stone-500">Urutan di daftar = urutan di header.</p>
            <button type="button" wire:click="addItem" class="text-sm font-semibold text-pondok-800 hover:underline">+ Tambah</button>
        </div>
        <div class="space-y-3">
            @foreach ($items as $index => $item)
                <section class="rounded-xl border border-[var(--pondok-line)] bg-white p-4 shadow-sm">
                    <div class="flex flex-wrap items-end gap-3">
                        <div class="min-w-[10rem] flex-1">
                            <label class="pondok-label">Label</label>
                            <input type="text" wire:model="items.{{ $index }}.label" class="pondok-input">
                        </div>
                        <div class="min-w-[12rem] flex-[2]">
                            <label class="pondok-label">URL</label>
                            <input type="text" wire:model="items.{{ $index }}.url" class="pondok-input" placeholder="/artikel">
                        </div>
                        <button type="button" wire:click="removeItem({{ $index }})" class="mb-0.5 text-sm text-rose-600 hover:underline">Hapus</button>
                    </div>
                </section>
            @endforeach
        </div>
        <button type="submit" class="admin-btn-primary" wire:loading.attr="disabled">Simpan</button>
    </form>
</div>
