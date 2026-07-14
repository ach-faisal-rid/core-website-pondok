<div>
    <x-admin.page-header title="Detail Pesan">
        <x-slot:action>
            <a href="{{ route('admin.contacts.index') }}" class="rounded border border-slate-300 bg-white px-4 py-2 text-sm hover:bg-slate-50">Kembali</a>
            <button
                type="button"
                wire:click="delete"
                wire:confirm="Hapus pesan ini?"
                class="rounded bg-rose-600 px-4 py-2 text-sm font-medium text-white hover:bg-rose-700"
            >Hapus</button>
        </x-slot:action>
    </x-admin.page-header>

    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <dl class="grid gap-4 sm:grid-cols-2">
            <div>
                <dt class="text-sm text-slate-500">Nama</dt>
                <dd class="font-medium text-slate-900">{{ $contactMessage->name }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Email</dt>
                <dd class="font-medium text-slate-900">
                    <a href="mailto:{{ $contactMessage->email }}" class="underline">{{ $contactMessage->email }}</a>
                </dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Telepon</dt>
                <dd class="font-medium text-slate-900">{{ $contactMessage->phone ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Tanggal</dt>
                <dd class="font-medium text-slate-900">{{ $contactMessage->created_at?->format('d/m/Y H:i') }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm text-slate-500">Subjek</dt>
                <dd class="font-medium text-slate-900">{{ $contactMessage->subject ?? '—' }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="mb-1 text-sm text-slate-500">Pesan</dt>
                <dd class="whitespace-pre-wrap rounded border border-slate-100 bg-slate-50 p-4 text-slate-800">{{ $contactMessage->message }}</dd>
            </div>
        </dl>
    </div>
</div>
