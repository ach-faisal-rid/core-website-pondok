<div>
    <x-admin.page-header
        title="Tema"
        description="Kelola nama situs, logo, favicon tab browser, dan warna merek website."
    />

    <form wire:submit="save" class="max-w-3xl space-y-6">
        <section class="space-y-5 rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm sm:p-6">
            <div>
                <h2 class="font-semibold text-pondok-900">Identitas situs</h2>
                <p class="mt-1 text-sm text-stone-500">Nama dan ikon yang tampil di website serta tab browser.</p>
            </div>

            <div>
                <label class="pondok-label" for="site_name">Nama situs</label>
                <input id="site_name" type="text" wire:model="site_name" class="pondok-input">
                @error('site_name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid items-stretch gap-4 md:grid-cols-2">
                {{-- Logo --}}
                <div class="flex flex-col rounded-xl border border-[var(--pondok-line)] bg-pondok-50/40 p-4">
                    <div class="mb-3">
                        <p class="text-sm font-semibold text-pondok-900">Logo</p>
                        <p class="mt-0.5 text-xs text-stone-500">Header website. PNG/JPG, disarankan transparan.</p>
                    </div>

                    <div class="flex min-h-[7.5rem] flex-1 items-center justify-center rounded-lg border border-dashed border-[var(--pondok-line)] bg-white px-4 py-5">
                        @if ($logoUrl)
                            <img src="{{ $logoUrl }}" alt="Preview logo" class="max-h-16 max-w-full object-contain">
                        @else
                            <div class="text-center">
                                <svg class="mx-auto h-8 w-8 text-stone-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.5-4.5a2 2 0 0 1 2.8 0L16 16m-2-2 1.2-1.2a2 2 0 0 1 2.8 0L20 14M6 20h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z"/></svg>
                                <p class="mt-2 text-xs text-stone-400">Belum ada logo</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-3 flex flex-wrap items-center gap-2">
                        <label class="admin-btn-secondary !px-3 !py-2 cursor-pointer text-xs">
                            <span wire:loading.remove wire:target="logo">Pilih file</span>
                            <span wire:loading wire:target="logo">Mengunggah...</span>
                            <input type="file" wire:model="logo" accept="image/png,image/jpeg,image/webp,image/svg+xml" class="sr-only">
                        </label>
                        @if ($logoUrl || $logo_path)
                            <button type="button" wire:click="removeLogo" class="rounded-lg px-3 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50">Hapus</button>
                        @endif
                    </div>
                    @error('logo') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>

                {{-- Favicon --}}
                <div class="flex flex-col rounded-xl border border-[var(--pondok-line)] bg-pondok-50/40 p-4">
                    <div class="mb-3">
                        <p class="text-sm font-semibold text-pondok-900">Favicon</p>
                        <p class="mt-0.5 text-xs text-stone-500">Tab browser. PNG/ICO, ideal 32&times;32 atau 64&times;64.</p>
                    </div>

                    <div class="flex min-h-[7.5rem] flex-1 items-center justify-center rounded-lg border border-dashed border-[var(--pondok-line)] bg-white px-4 py-5">
                        @if ($faviconUrl)
                            <img src="{{ $faviconUrl }}" alt="Preview favicon" class="h-12 w-12 rounded-md object-contain shadow-sm">
                        @else
                            <div class="text-center">
                                <svg class="mx-auto h-8 w-8 text-stone-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.1h4.5l.9 2.7H18a1.35 1.35 0 0 1 1.35 1.35v9.9A1.35 1.35 0 0 1 18 18.4H6a1.35 1.35 0 0 1-1.35-1.35v-9.9A1.35 1.35 0 0 1 6 5.8h2.85l.9-2.7Z"/><circle cx="12" cy="12.2" r="2.6"/></svg>
                                <p class="mt-2 text-xs text-stone-400">Belum ada favicon</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-3 flex flex-wrap items-center gap-2">
                        <label class="admin-btn-secondary !px-3 !py-2 cursor-pointer text-xs">
                            <span wire:loading.remove wire:target="favicon">Pilih file</span>
                            <span wire:loading wire:target="favicon">Mengunggah...</span>
                            <input type="file" wire:model="favicon" accept="image/png,image/x-icon,image/vnd.microsoft.icon,.ico,image/jpeg,image/webp" class="sr-only">
                        </label>
                        @if ($faviconUrl || $favicon_path)
                            <button type="button" wire:click="removeFavicon" class="rounded-lg px-3 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50">Hapus</button>
                        @endif
                    </div>
                    @error('favicon') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </section>

        <section class="space-y-4 rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm sm:p-6">
            <div>
                <h2 class="font-semibold text-pondok-900">Warna merek</h2>
                <p class="mt-1 text-sm text-stone-500">Warna primer dan sekunder untuk aksen tampilan.</p>
            </div>
            <div class="grid gap-4 md:grid-cols-2">
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
        </section>

        <button type="submit" class="admin-btn-primary" wire:loading.attr="disabled">Simpan</button>
    </form>
</div>
