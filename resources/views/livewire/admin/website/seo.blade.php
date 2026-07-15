<div>
    <x-admin.page-header title="SEO" description="Judul dan deskripsi meta default untuk mesin pencari." />
    <form wire:submit="save" class="max-w-3xl space-y-4 rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm sm:p-6">
        <div>
            <label class="pondok-label">Judul SEO</label>
            <input type="text" wire:model="seo_title" class="pondok-input">
        </div>
        <div>
            <label class="pondok-label">Deskripsi SEO</label>
            <textarea wire:model="seo_description" rows="3" class="pondok-input"></textarea>
        </div>
        <button type="submit" class="admin-btn-primary" wire:loading.attr="disabled">Simpan</button>
    </form>
</div>
