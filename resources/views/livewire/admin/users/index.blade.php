<div>
    <x-admin.page-header title="Pengguna">
        <x-slot:action>
            <a href="{{ route('admin.users.create') }}" class="rounded bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">Tambah Pengguna</a>
        </x-slot:action>
    </x-admin.page-header>

    <div class="mb-4">
        <input
            type="search"
            wire:model.live.debounce.300ms="search"
            placeholder="Cari nama atau email..."
            class="w-full max-w-md rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500"
        >
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-600">
                <tr>
                    <th class="cursor-pointer px-4 py-3 font-medium" wire:click="sortBy('name')">Nama</th>
                    <th class="cursor-pointer px-4 py-3 font-medium" wire:click="sortBy('email')">Email</th>
                    <th class="cursor-pointer px-4 py-3 font-medium" wire:click="sortBy('role')">Peran</th>
                    <th class="px-4 py-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($users as $item)
                    <tr>
                        <td class="px-4 py-3 font-medium text-slate-900">{{ $item->name }}</td>
                        <td class="px-4 py-3 text-slate-500">{{ $item->email }}</td>
                        <td class="px-4 py-3">{{ $item->role->label() }}</td>
                        <td class="space-x-2 px-4 py-3 text-right">
                            <a href="{{ route('admin.users.edit', $item) }}" class="text-slate-700 underline hover:text-slate-900">Edit</a>
                            @if (auth()->id() !== $item->id)
                                <button
                                    type="button"
                                    wire:click="delete({{ $item->id }})"
                                    wire:confirm="Hapus pengguna ini?"
                                    class="text-rose-600 underline hover:text-rose-800"
                                >Hapus</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-slate-500">Belum ada pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $users->links() }}</div>
</div>
