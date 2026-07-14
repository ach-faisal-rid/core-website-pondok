<div>
    <x-admin.page-header title="Pengaturan Situs" />

    <form wire:submit="save" class="space-y-8">
        <section class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-medium text-slate-900">Umum</h2>
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-1 block text-sm font-medium">Nama Situs</label>
                    <input type="text" wire:model="site_name" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                    @error('site_name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Tagline</label>
                    <input type="text" wire:model="site_tagline" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                    @error('site_tagline') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Logo</label>
                    <input type="file" wire:model="logo" accept="image/*" class="w-full text-sm">
                    @if ($logoUrl)
                        <img src="{{ $logoUrl }}" alt="Logo" class="mt-2 h-16 object-contain">
                    @endif
                    @error('logo') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Favicon</label>
                    <input type="file" wire:model="favicon" accept="image/*" class="w-full text-sm">
                    @if ($faviconUrl)
                        <img src="{{ $faviconUrl }}" alt="Favicon" class="mt-2 h-8 w-8 object-contain">
                    @endif
                    @error('favicon') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="mb-1 block text-sm font-medium">Teks Footer</label>
                    <textarea wire:model="footer_text" rows="3" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500"></textarea>
                    @error('footer_text') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </section>

        <section class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-medium text-slate-900">SEO</h2>
            <div class="grid gap-4">
                <div>
                    <label class="mb-1 block text-sm font-medium">Judul SEO</label>
                    <input type="text" wire:model="seo_title" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                    @error('seo_title') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Deskripsi SEO</label>
                    <textarea wire:model="seo_description" rows="3" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500"></textarea>
                    @error('seo_description') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </section>

        <section class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-medium text-slate-900">Kontak</h2>
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-1 block text-sm font-medium">Telepon</label>
                    <input type="text" wire:model="phone" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                    @error('phone') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">WhatsApp</label>
                    <input type="text" wire:model="whatsapp" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                    @error('whatsapp') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Email</label>
                    <input type="email" wire:model="email" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                    @error('email') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Alamat</label>
                    <textarea wire:model="address" rows="2" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500"></textarea>
                    @error('address') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="mb-1 block text-sm font-medium">Embed Maps</label>
                    <textarea wire:model="maps_embed" rows="3" class="w-full rounded border-slate-300 font-mono text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500" placeholder="Tempel iframe Google Maps"></textarea>
                    @error('maps_embed') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </section>

        <section class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-medium text-slate-900">Media Sosial</h2>
            <div class="grid gap-4 md:grid-cols-3">
                <div>
                    <label class="mb-1 block text-sm font-medium">Facebook</label>
                    <input type="url" wire:model="facebook" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                    @error('facebook') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">Instagram</label>
                    <input type="url" wire:model="instagram" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                    @error('instagram') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium">YouTube</label>
                    <input type="url" wire:model="youtube" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                    @error('youtube') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </section>

        <div class="flex justify-end">
            <button type="submit" class="admin-btn-primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Simpan Pengaturan</span>
                <span wire:loading>Menyimpan...</span>
            </button>
        </div>
    </form>
</div>
