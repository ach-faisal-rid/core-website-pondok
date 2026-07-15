<div>
    <x-admin.page-header title="Footer" description="Tagline, teks footer, kontak, dan tautan sosial." />
    <form wire:submit="save" class="max-w-3xl space-y-4 rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm sm:p-6">
        <div>
            <label class="pondok-label">Tagline</label>
            <input type="text" wire:model="site_tagline" class="pondok-input">
        </div>
        <div>
            <label class="pondok-label">Teks footer</label>
            <textarea wire:model="footer_text" rows="3" class="pondok-input"></textarea>
        </div>
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="pondok-label">Telepon</label>
                <input type="text" wire:model="phone" class="pondok-input">
            </div>
            <div>
                <label class="pondok-label">Email</label>
                <input type="email" wire:model="email" class="pondok-input">
                @error('email') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="pondok-label">Facebook</label>
                <input type="url" wire:model="facebook" class="pondok-input" placeholder="https://">
                @error('facebook') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="pondok-label">Instagram</label>
                <input type="url" wire:model="instagram" class="pondok-input" placeholder="https://">
                @error('instagram') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="pondok-label">YouTube</label>
                <input type="url" wire:model="youtube" class="pondok-input" placeholder="https://">
                @error('youtube') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
        </div>
        <button type="submit" class="admin-btn-primary" wire:loading.attr="disabled">Simpan</button>
    </form>
</div>
