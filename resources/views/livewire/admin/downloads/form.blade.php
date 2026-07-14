<div>
    <x-admin.page-header :title="$download ? 'Edit Download' : 'Tambah Download'">
        <x-slot:action>
            <a href="{{ route('admin.downloads.index') }}" class="rounded border border-slate-300 bg-white px-4 py-2 text-sm hover:bg-slate-50">Kembali</a>
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
            <label class="mb-1 block text-sm font-medium">Deskripsi singkat</label>
            <textarea wire:model="description" rows="3" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500" placeholder="Ditampilkan di kartu unduhan publik"></textarea>
            @error('description') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="mb-1 block text-sm font-medium">Kategori</label>
                <select wire:model="category" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                    <option value="">— Pilih —</option>
                    <option value="Administrasi Santri">Administrasi Santri</option>
                    <option value="Kurikulum & Akademik">Kurikulum & Akademik</option>
                    <option value="Laporan & Publikasi">Laporan & Publikasi</option>
                </select>
                @error('category') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">File {{ $download ? '(opsional untuk ganti)' : '' }}</label>
                <input type="file" wire:model="file" class="w-full text-sm">
                <div wire:loading wire:target="file" class="mt-1 text-sm text-slate-500">Mengunggah...</div>
                @if ($file_path)
                    <p class="mt-2 text-sm text-slate-500">File saat ini: {{ basename($file_path) }} ({{ number_format($file_size / 1024, 1) }} KB)</p>
                @endif
                @error('file') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="rounded bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800" wire:loading.attr="disabled">
                Simpan
            </button>
        </div>
    </form>
</div>
