<div>
    <x-admin.page-header :title="$album ? 'Edit Album' : 'Tambah Album'">
        <x-slot:action>
            <a href="{{ route('admin.albums.index') }}" class="rounded border border-slate-300 bg-white px-4 py-2 text-sm hover:bg-slate-50">Kembali</a>
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
            <label class="mb-1 block text-sm font-medium">Deskripsi</label>
            <textarea wire:model="description" rows="4" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500"></textarea>
            @error('description') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium">Kategori</label>
            <select wire:model="category" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                <option value="">— Pilih —</option>
                @foreach (\App\Models\Album::CATEGORIES as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
            @error('category') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="mb-1 block text-sm font-medium">Thumbnail</label>
                <input type="file" wire:model="thumbnail" accept="image/*" class="w-full text-sm">
                @if ($thumbnail_path)
                    <img src="{{ Storage::disk('public')->url($thumbnail_path) }}" alt="" class="mt-2 h-24 rounded object-cover">
                @endif
                @error('thumbnail') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Upload foto (bisa banyak)</label>
                <input type="file" wire:model="photos" accept="image/*" multiple class="w-full text-sm">
                <div wire:loading wire:target="photos" class="mt-1 text-sm text-slate-500">Mengunggah...</div>
                @error('photos.*') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
        </div>

        @if ($album && $album->media->isNotEmpty())
            <div>
                <h3 class="mb-3 text-sm font-medium text-slate-900">Foto di album</h3>
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-4">
                    @foreach ($album->media as $media)
                        <div class="relative overflow-hidden rounded border border-slate-200">
                            <img src="{{ $media->url() }}" alt="" class="h-32 w-full object-cover">
                            <button
                                type="button"
                                wire:click="deletePhoto({{ $media->id }})"
                                wire:confirm="Hapus foto ini?"
                                class="absolute right-2 top-2 rounded bg-rose-600 px-2 py-1 text-xs text-white hover:bg-rose-700"
                            >Hapus</button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="flex justify-end">
            <button type="submit" class="rounded bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800" wire:loading.attr="disabled">
                Simpan Album
            </button>
        </div>
    </form>
</div>
