<div>
    <x-admin.page-header title="Pengasuh" description="Data pengasuh: foto, nama, jabatan, dan sambutan." />
    <form wire:submit="save" class="space-y-6">
        <div class="grid gap-6 md:grid-cols-2">
            <section class="rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm">
                <h2 class="mb-3 font-semibold text-pondok-900">Pengasuh 1</h2>
                <div class="space-y-3">
                    <div>
                        <label class="pondok-label">Nama</label>
                        <input type="text" wire:model="pengasuh_1_name" class="pondok-input">
                    </div>
                    <div>
                        <label class="pondok-label">Jabatan</label>
                        <input type="text" wire:model="pengasuh_1_title" class="pondok-input">
                    </div>
                    <div>
                        <label class="pondok-label">Sambutan</label>
                        <textarea wire:model="pengasuh_1_sambutan" rows="5" class="pondok-input"></textarea>
                    </div>
                    <div>
                        <label class="pondok-label">Foto</label>
                        <input type="file" wire:model="pengasuh_1_photo" accept="image/*" class="mt-1.5 w-full text-sm">
                        @if ($photo1)
                            <img src="{{ $photo1 }}" alt="" class="mt-2 h-28 rounded-lg object-cover">
                        @endif
                    </div>
                </div>
            </section>
            <section class="rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm">
                <h2 class="mb-3 font-semibold text-pondok-900">Pengasuh 2</h2>
                <div class="space-y-3">
                    <div>
                        <label class="pondok-label">Nama</label>
                        <input type="text" wire:model="pengasuh_2_name" class="pondok-input">
                    </div>
                    <div>
                        <label class="pondok-label">Jabatan</label>
                        <input type="text" wire:model="pengasuh_2_title" class="pondok-input">
                    </div>
                    <div>
                        <label class="pondok-label">Sambutan</label>
                        <textarea wire:model="pengasuh_2_sambutan" rows="5" class="pondok-input"></textarea>
                    </div>
                    <div>
                        <label class="pondok-label">Foto</label>
                        <input type="file" wire:model="pengasuh_2_photo" accept="image/*" class="mt-1.5 w-full text-sm">
                        @if ($photo2)
                            <img src="{{ $photo2 }}" alt="" class="mt-2 h-28 rounded-lg object-cover">
                        @endif
                    </div>
                </div>
            </section>
        </div>
        <button type="submit" class="admin-btn-primary" wire:loading.attr="disabled">Simpan</button>
    </form>
</div>
