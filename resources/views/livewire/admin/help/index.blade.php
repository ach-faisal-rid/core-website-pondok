<div>
    <x-admin.page-header
        title="Bantuan"
        description="Panduan penggunaan CMS pondok untuk operator. Cari topik atau buka kategori di bawah."
    >
        <x-slot:action>
            @can('create', App\Models\HelpArticle::class)
                <a href="{{ route('admin.help.manage') }}" class="admin-btn-primary">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9.6 4.8h4.8l.8 2.4H18a1.2 1.2 0 0 1 1.2 1.2v9.6A1.2 1.2 0 0 1 18 19.2H6a1.2 1.2 0 0 1-1.2-1.2V8.4A1.2 1.2 0 0 1 6 7.2h2.8l.8-2.4Z"/><circle cx="12" cy="13.2" r="2.4"/></svg>
                    Kelola Bantuan
                </a>
            @endcan
        </x-slot:action>
    </x-admin.page-header>

    <div class="mb-5 grid gap-3 sm:grid-cols-3">
        <div class="admin-stat-card sm:col-span-1">
            <p class="text-[11px] font-semibold uppercase tracking-[0.14em] text-stone-400">Topik tersedia</p>
            <p class="mt-1 text-2xl font-semibold tabular-nums text-pondok-900">{{ $totalTopics }}</p>
        </div>
        <div class="sm:col-span-2">
            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-stone-500">Cari bantuan</label>
            <div class="relative">
                <input
                    type="search"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari topik bantuan..."
                    class="admin-input pl-10"
                >
                <span class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center text-stone-400">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14Z"/></svg>
                </span>
            </div>
        </div>
    </div>

    @if ($grouped->isEmpty())
        <x-admin.empty-state
            title="Belum ada panduan"
            description="{{ $search !== '' ? 'Tidak ada hasil untuk pencarian ini. Coba kata kunci lain.' : 'Admin dapat menambahkan panduan melalui Kelola Bantuan.' }}"
            :action-href="auth()->user()->can('create', App\Models\HelpArticle::class) && $search === '' ? route('admin.help.manage') : null"
            :action-label="auth()->user()->can('create', App\Models\HelpArticle::class) && $search === '' ? 'Kelola Bantuan' : null"
        >
            <x-slot:icon>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 17h.01M9.2 9.2a2.8 2.8 0 1 1 4.4 2.3c-.8.5-1.6 1.1-1.6 2v.5"/><circle cx="12" cy="12" r="9"/></svg>
            </x-slot:icon>
        </x-admin.empty-state>
    @else
        <div class="space-y-3">
            @foreach ($grouped as $group)
                @php
                    /** @var \App\Enums\HelpCategory $category */
                    $category = $group['category'];
                    $items = $group['items'];
                @endphp

                <section
                    class="overflow-hidden rounded-xl border border-[var(--pondok-line)] bg-white shadow-sm"
                    x-data="{ open: {{ $loop->first ? 'true' : 'false' }} }"
                >
                    <button
                        type="button"
                        class="flex w-full items-center gap-3 px-4 py-3.5 text-left hover:bg-pondok-50/60 sm:px-5"
                        @click="open = !open"
                    >
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-pondok-50 text-xs font-bold text-pondok-800">
                            {{ $items->count() }}
                        </span>
                        <span class="min-w-0 flex-1 font-semibold text-pondok-900">{{ $category->label() }}</span>
                        <svg class="h-4 w-4 shrink-0 text-stone-400 transition-transform" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6"/></svg>
                    </button>

                    <div x-show="open" x-cloak class="border-t border-[var(--pondok-line)]">
                        <div class="divide-y divide-[var(--pondok-line)]">
                            @foreach ($items as $item)
                                <details class="group px-4 py-3.5 sm:px-5" @if ($loop->first && $loop->parent->first) open @endif>
                                    <summary class="cursor-pointer list-none font-medium text-stone-800 marker:content-none hover:text-pondok-900">
                                        <span class="inline-flex items-center gap-2">
                                            {{ $item->title }}
                                            @unless ($item->is_published)
                                                <span class="admin-badge bg-amber-50 text-amber-700">Draft</span>
                                            @endunless
                                        </span>
                                    </summary>
                                    <div class="prose prose-sm mt-3 max-w-none text-stone-600 prose-headings:text-pondok-900 prose-a:text-pondok-800 prose-strong:text-stone-800 prose-code:rounded prose-code:bg-pondok-50 prose-code:px-1 prose-code:text-pondok-900">
                                        {!! $item->body !!}
                                    </div>
                                </details>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endforeach
        </div>
    @endif
</div>
