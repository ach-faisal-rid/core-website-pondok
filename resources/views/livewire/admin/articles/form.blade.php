<div>
    <x-admin.page-header :title="$article ? 'Edit Artikel' : 'Tambah Artikel'">
        <x-slot:action>
            <a href="{{ route('admin.articles.index') }}" class="rounded border border-slate-300 bg-white px-4 py-2 text-sm hover:bg-slate-50">Kembali</a>
        </x-slot:action>
    </x-admin.page-header>

    <form wire:submit="save" class="space-y-6 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="mb-1 block text-sm font-medium">Judul</label>
                <input type="text" wire:model.live="title" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                @error('title') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Slug</label>
                <input type="text" wire:model="slug" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                @error('slug') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Isi</label>
            <textarea wire:model="body" rows="10" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500"></textarea>
            @error('body') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <div>
                <label class="mb-1 block text-sm font-medium">Tipe</label>
                <select wire:model="type" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                    @foreach ($types as $articleType)
                        <option value="{{ $articleType->value }}">{{ $articleType->label() }}</option>
                    @endforeach
                </select>
                @error('type') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Kategori</label>
                <select wire:model="category_id" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                    <option value="">— Pilih —</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Kategori baru</label>
                <input type="text" wire:model="new_category" placeholder="Opsional" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                @error('new_category') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Tag (pisahkan dengan koma)</label>
            <input type="text" wire:model="tags_input" placeholder="pondok, santri, kegiatan" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
            @error('tags_input') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <div>
                <label class="mb-1 block text-sm font-medium">Status</label>
                <select wire:model="status" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                    @foreach ($statuses as $publishStatus)
                        <option value="{{ $publishStatus->value }}">{{ $publishStatus->label() }}</option>
                    @endforeach
                </select>
                @error('status') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Tanggal Terbit</label>
                <input type="datetime-local" wire:model="published_at" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                @error('published_at') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Thumbnail</label>
                <input type="file" wire:model="thumbnail" accept="image/*" class="w-full text-sm">
                @if ($thumbnail_path)
                    <img src="{{ Storage::disk('public')->url($thumbnail_path) }}" alt="" class="mt-2 h-24 rounded object-cover">
                @endif
                @error('thumbnail') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="mb-1 block text-sm font-medium">SEO Title</label>
                <input type="text" wire:model="seo_title" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                @error('seo_title') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">SEO Description</label>
                <textarea wire:model="seo_description" rows="2" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500"></textarea>
                @error('seo_description') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="rounded bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800" wire:loading.attr="disabled">
                Simpan Artikel
            </button>
        </div>
    </form>
</div>
