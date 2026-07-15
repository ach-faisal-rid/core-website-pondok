<div>
    <x-admin.page-header title="Panca Jiwa" description="Judul section, intro, dan daftar butir Panca Jiwa." />
    <form wire:submit="save" class="space-y-6">
        <section class="max-w-3xl space-y-4 rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm sm:p-6">
            <div>
                <label class="pondok-label">Judul section</label>
                <input type="text" wire:model="panca_section_title" class="pondok-input">
            </div>
            <div>
                <label class="pondok-label">Intro singkat</label>
                <textarea wire:model="home_panca_intro" rows="2" class="pondok-input"></textarea>
            </div>
        </section>

        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-pondok-900">Butir Panca Jiwa</h2>
                <button type="button" wire:click="addItem" class="text-sm font-semibold text-pondok-800 hover:underline">+ Tambah</button>
            </div>
            @foreach ($panca_jiwa as $index => $item)
                <section class="rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm">
                    <div class="mb-3 flex items-center justify-between">
                        <p class="text-sm font-medium text-stone-500">Item {{ $index + 1 }}</p>
                        <button type="button" wire:click="removeItem({{ $index }})" class="text-sm text-rose-600 hover:underline">Hapus</button>
                    </div>
                    <div class="grid gap-3 md:grid-cols-3">
                        <div>
                            <label class="pondok-label">Judul</label>
                            <input type="text" wire:model="panca_jiwa.{{ $index }}.title" class="pondok-input">
                        </div>
                        <div>
                            <label class="pondok-label">Ikon</label>
                            <select wire:model="panca_jiwa.{{ $index }}.icon" class="pondok-input">
                                @foreach ($iconOptions as $icon)
                                    <option value="{{ $icon }}">{{ $icon }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-3">
                            <label class="pondok-label">Deskripsi</label>
                            <textarea wire:model="panca_jiwa.{{ $index }}.description" rows="2" class="pondok-input"></textarea>
                        </div>
                    </div>
                </section>
            @endforeach
        </div>

        <button type="submit" class="admin-btn-primary" wire:loading.attr="disabled">Simpan</button>
    </form>
</div>
