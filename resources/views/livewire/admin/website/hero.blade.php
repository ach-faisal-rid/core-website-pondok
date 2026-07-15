<div>
    <x-admin.page-header title="Hero" description="Judul, subtitle, tombol, dan background bagian paling atas beranda." />
    <form wire:submit="save" class="max-w-3xl space-y-4 rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm sm:p-6">
        <div><label class="pondok-label">Judul</label><input type="text" wire:model="home_hero_title" class="pondok-input"></div>
        <div><label class="pondok-label">Subtitle</label><textarea wire:model="home_hero_subtitle" rows="3" class="pondok-input"></textarea></div>
        <div><label class="pondok-label">Background</label><input type="file" wire:model="home_hero" accept="image/*" class="mt-1.5 w-full text-sm">@if($preview)<img src="{{ $preview }}" class="mt-2 h-28 rounded-lg object-cover">@endif</div>
        <div class="grid gap-4 md:grid-cols-2">
            <div><label class="pondok-label">Tombol 1 — teks</label><input type="text" wire:model="home_cta1_label" class="pondok-input"></div>
            <div><label class="pondok-label">Tombol 1 — URL</label><input type="text" wire:model="home_cta1_url" class="pondok-input"></div>
            <div><label class="pondok-label">Tombol 2 — teks</label><input type="text" wire:model="home_cta2_label" class="pondok-input"></div>
            <div><label class="pondok-label">Tombol 2 — URL</label><input type="text" wire:model="home_cta2_url" class="pondok-input"></div>
        </div>
        <button type="submit" class="admin-btn-primary" wire:loading.attr="disabled">Simpan</button>
    </form>
</div>
