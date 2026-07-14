<div>
    <x-admin.page-header title="Bantuan & Panduan CMS">
        <x-slot:action>
            @can('create', App\Models\HelpArticle::class)
                <a href="{{ route('admin.help.manage') }}" class="rounded bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
                    Kelola Bantuan
                </a>
            @endcan
        </x-slot:action>
    </x-admin.page-header>

    <p class="mb-6 text-sm text-slate-600">
        Panduan pengelolaan CMS dan pertanyaan umum seputar panel admin, dikelompokkan per modul.
    </p>

    <div class="mb-6">
        <input
            type="search"
            wire:model.live.debounce.300ms="search"
            placeholder="Cari topik bantuan..."
            class="w-full max-w-md rounded border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500"
        >
    </div>

    <div class="space-y-4">
        @forelse ($grouped as $group)
            @php
                /** @var \App\Enums\HelpCategory $category */
                $category = $group['category'];
                $items = $group['items'];
            @endphp

            @if ($items->isNotEmpty())
                <section class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm" x-data="{ open: {{ $loop->first ? 'true' : 'false' }} }">
                    <button
                        type="button"
                        class="flex w-full items-center justify-between px-4 py-3 text-left font-medium text-slate-900 hover:bg-slate-50 sm:px-5"
                        @click="open = !open"
                    >
                        <span>{{ $category->label() }}</span>
                        <span class="text-xs text-slate-500" x-text="open ? 'Tutup' : 'Buka'"></span>
                    </button>

                    <div x-show="open" x-cloak class="border-t border-slate-100">
                        <div class="divide-y divide-slate-100">
                            @foreach ($items as $item)
                                <details class="group px-4 py-3 sm:px-5" @if($loop->first) open @endif>
                                    <summary class="cursor-pointer list-none font-medium text-slate-800 marker:content-none hover:text-slate-950">
                                        {{ $item->title }}
                                        @unless($item->is_published)
                                            <span class="ml-2 rounded bg-amber-50 px-2 py-0.5 text-xs font-medium text-amber-700">Draft</span>
                                        @endunless
                                    </summary>
                                    <div class="prose prose-sm mt-3 max-w-none text-slate-600 prose-headings:text-slate-800">
                                        {!! $item->body !!}
                                    </div>
                                </details>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
        @empty
            <div class="rounded-lg border border-slate-200 bg-white px-6 py-10 text-center text-slate-500 shadow-sm">
                @if ($search !== '')
                    Tidak ada hasil untuk pencarian ini.
                @else
                    Belum ada panduan bantuan. Admin dapat menambahkan melalui Kelola Bantuan.
                @endif
            </div>
        @endforelse
    </div>
</div>
