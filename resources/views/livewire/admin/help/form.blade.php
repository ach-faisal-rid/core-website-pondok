<div>
    <x-admin.page-header
        :title="$helpArticle ? 'Edit Item Bantuan' : 'Tambah Item Bantuan'"
        description="Tulis judul yang jelas dan jawaban praktis agar operator langsung tahu langkahnya."
    >
        <x-slot:action>
            <a href="{{ route('admin.help.manage') }}" class="admin-btn-secondary">Kembali</a>
        </x-slot:action>
    </x-admin.page-header>

    <form wire:submit="save" class="max-w-3xl space-y-5 rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm sm:p-6">
        <div>
            <label for="title" class="pondok-label">Judul</label>
            <input id="title" type="text" wire:model="title" class="pondok-input" required>
            @error('title') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="category" class="pondok-label">Kategori</label>
                <select id="category" wire:model="category" class="pondok-input">
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->value }}">{{ $cat->label() }}</option>
                    @endforeach
                </select>
                @error('category') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="sort_order" class="pondok-label">Urutan</label>
                <input id="sort_order" type="number" min="0" max="9999" wire:model="sort_order" class="pondok-input">
                @error('sort_order') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="inline-flex items-center gap-2 text-sm text-stone-700">
                <input type="checkbox" wire:model="is_published" class="rounded border-[var(--pondok-line)] text-pondok-800 focus:ring-pondok-700">
                Tampilkan di halaman bantuan
            </label>
            @error('is_published') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="body" class="pondok-label">Isi panduan / jawaban</label>
            <textarea
                id="body"
                wire:model="body"
                rows="12"
                class="pondok-input font-mono text-sm"
                placeholder="Gunakan HTML sederhana: <p>, <ol>, <ul>, <strong>"
            ></textarea>
            @error('body') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <button type="submit" class="admin-btn-primary" wire:loading.attr="disabled">Simpan</button>
            <a href="{{ route('admin.help.manage') }}" class="text-sm font-semibold text-stone-600 hover:text-pondok-800 hover:underline">Batal</a>
        </div>
    </form>
</div>
