<div>
    <x-admin.page-header title="Statistik" description="Angka ringkas di beranda: santri, ustadz, tahun berdiri, dll." />
    <form wire:submit="save" class="space-y-6">
        <div class="flex items-center justify-between">
            <p class="text-sm text-stone-500">Tambah atau hapus item statistik sesuai kebutuhan.</p>
            <button type="button" wire:click="addItem" class="text-sm font-semibold text-pondok-800 hover:underline">+ Tambah</button>
        </div>
        <div class="space-y-3">
            @foreach ($stats as $index => $item)
                <section class="rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm">
                    <div class="mb-3 flex items-center justify-between">
                        <p class="text-sm font-medium text-stone-500">Stat {{ $index + 1 }}</p>
                        <button type="button" wire:click="removeItem({{ $index }})" class="text-sm text-rose-600 hover:underline">Hapus</button>
                    </div>
                    <div class="grid gap-3 md:grid-cols-3">
                        <div>
                            <label class="pondok-label">Nilai</label>
                            <input type="text" wire:model="stats.{{ $index }}.value" class="pondok-input" placeholder="1000+">
                        </div>
                        <div>
                            <label class="pondok-label">Label</label>
                            <input type="text" wire:model="stats.{{ $index }}.label" class="pondok-input" placeholder="Santri">
                        </div>
                        <div>
                            <label class="pondok-label">Ikon</label>
                            <select wire:model="stats.{{ $index }}.icon" class="pondok-input">
                                @foreach ($iconOptions as $icon)
                                    <option value="{{ $icon }}">{{ $icon }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </section>
            @endforeach
        </div>
        <button type="submit" class="admin-btn-primary" wire:loading.attr="disabled">Simpan</button>
    </form>
</div>
