<div>
    <x-admin.page-header :title="$helpArticle ? 'Edit Item Bantuan' : 'Tambah Item Bantuan'" />

    <form wire:submit="save" class="max-w-3xl space-y-5 rounded-lg border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
        <div>
            <label for="title" class="block text-sm font-medium text-slate-700">Judul</label>
            <input id="title" type="text" wire:model="title" class="mt-1 w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500" required>
            @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="category" class="block text-sm font-medium text-slate-700">Kategori</label>
                <select id="category" wire:model="category" class="mt-1 w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->value }}">{{ $cat->label() }}</option>
                    @endforeach
                </select>
                @error('category') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="sort_order" class="block text-sm font-medium text-slate-700">Urutan</label>
                <input id="sort_order" type="number" min="0" max="9999" wire:model="sort_order" class="mt-1 w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                @error('sort_order') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                <input type="checkbox" wire:model="is_published" class="rounded border-slate-300 text-slate-900 focus:ring-slate-500">
                Tampilkan di halaman bantuan
            </label>
            @error('is_published') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="body" class="block text-sm font-medium text-slate-700">Isi panduan / jawaban</label>
            <textarea
                id="body"
                wire:model="body"
                rows="12"
                class="mt-1 w-full rounded border-slate-300 font-mono text-sm shadow-sm focus:border-slate-500 focus:ring-slate-500"
                placeholder="Gunakan HTML sederhana: &lt;p&gt;, &lt;ol&gt;, &lt;ul&gt;, &lt;strong&gt;"
            ></textarea>
            @error('body') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <button type="submit" class="rounded bg-slate-900 px-5 py-2.5 text-sm font-medium text-white hover:bg-slate-800" wire:loading.attr="disabled">
                Simpan
            </button>
            <a href="{{ route('admin.help.manage') }}" class="text-sm text-slate-600 underline hover:text-slate-900">Batal</a>
        </div>
    </form>
</div>
