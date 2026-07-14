<div>
    <x-admin.page-header :title="$user ? 'Edit Pengguna' : 'Tambah Pengguna'">
        <x-slot:action>
            <a href="{{ route('admin.users.index') }}" class="rounded border border-slate-300 bg-white px-4 py-2 text-sm hover:bg-slate-50">Kembali</a>
        </x-slot:action>
    </x-admin.page-header>

    <form wire:submit="save" class="space-y-6 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="mb-1 block text-sm font-medium">Nama</label>
                <input type="text" wire:model="name" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                @error('name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Email</label>
                <input type="email" wire:model="email" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                @error('email') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Password {{ $user ? '(opsional)' : '' }}</label>
                <input type="password" wire:model="password" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500" autocomplete="new-password">
                @error('password') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Konfirmasi Password</label>
                <input type="password" wire:model="password_confirmation" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500" autocomplete="new-password">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium">Peran</label>
                <select wire:model="role" class="w-full rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                    @foreach ($roles as $userRole)
                        <option value="{{ $userRole->value }}">{{ $userRole->label() }}</option>
                    @endforeach
                </select>
                @error('role') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="admin-btn-primary" wire:loading.attr="disabled">
                Simpan
            </button>
        </div>
    </form>
</div>
