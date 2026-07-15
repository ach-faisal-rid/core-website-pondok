<div>
    <x-admin.page-header title="Tema" description="Nama situs, logo, favicon, dan warna merek." />
    <form wire:submit="save" class="max-w-3xl space-y-4 rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm sm:p-6">
        <div>
            <label class="pondok-label">Nama situs</label>
            <input type="text" wire:model="site_name" class="pondok-input">
            @error('site_name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="pondok-label">Logo</label>
                <input type="file" wire:model="logo" accept="image/*" class="mt-1.5 w-full text-sm">
                @if ($logoUrl)
                    <img src="{{ $logoUrl }}" alt="Logo" class="mt-2 h-16 object-contain">
                @endif
            </div>
            <div>
                <label class="pondok-label">Favicon</label>
                <input type="file" wire:model="favicon" accept="image/*" class="mt-1.5 w-full text-sm">
                @if ($faviconUrl)
                    <img src="{{ $faviconUrl }}" alt="Favicon" class="mt-2 h-8 w-8 object-contain">
                @endif
            </div>
            <div>
                <label class="pondok-label">Warna primer</label>
                <div class="mt-1.5 flex items-center gap-3">
                    <input type="color" wire:model.live="theme_primary" class="h-10 w-14 cursor-pointer rounded border border-[var(--pondok-line)]">
                    <input type="text" wire:model="theme_primary" class="pondok-input">
                </div>
            </div>
            <div>
                <label class="pondok-label">Warna sekunder</label>
                <div class="mt-1.5 flex items-center gap-3">
                    <input type="color" wire:model.live="theme_secondary" class="h-10 w-14 cursor-pointer rounded border border-[var(--pondok-line)]">
                    <input type="text" wire:model="theme_secondary" class="pondok-input">
                </div>
            </div>
        </div>
        <button type="submit" class="admin-btn-primary" wire:loading.attr="disabled">Simpan</button>
    </form>
</div>
