<div>
    <x-admin.page-header
        title="Pengaturan Situs"
        description="Kelola identitas website: umum, beranda, profil, dan kontak tanpa mengubah kode."
    />

    <div class="mb-6 flex flex-wrap gap-1 border-b border-[var(--pondok-line)]">
        @foreach ([
            'umum' => 'Umum',
            'beranda' => 'Beranda',
            'profil' => 'Profil',
            'kontak' => 'Kontak',
        ] as $key => $label)
            <button
                type="button"
                wire:click="setTab('{{ $key }}')"
                @class([
                    'px-4 py-2.5 text-sm font-semibold transition border-b-2 -mb-px',
                    'border-pondok-800 text-pondok-900' => $activeTab === $key,
                    'border-transparent text-stone-500 hover:text-pondok-800' => $activeTab !== $key,
                ])
            >{{ $label }}</button>
        @endforeach
    </div>

    <form wire:submit="save" class="space-y-6">
        {{-- UMUM --}}
        <div @class(['space-y-6' => true, 'hidden' => $activeTab !== 'umum'])>
            <section class="rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm sm:p-6">
                <h2 class="mb-4 font-display text-xl font-semibold text-pondok-900">Identitas & SEO</h2>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="pondok-label">Nama Situs</label>
                        <input type="text" wire:model="site_name" class="pondok-input">
                        @error('site_name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="pondok-label">Tagline</label>
                        <input type="text" wire:model="site_tagline" class="pondok-input">
                        @error('site_tagline') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="pondok-label">Logo</label>
                        <input type="file" wire:model="logo" accept="image/*" class="mt-1.5 w-full text-sm">
                        @if ($logoUrl)
                            <img src="{{ $logoUrl }}" alt="Logo" class="mt-2 h-16 object-contain">
                        @endif
                        @error('logo') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="pondok-label">Favicon</label>
                        <input type="file" wire:model="favicon" accept="image/*" class="mt-1.5 w-full text-sm">
                        @if ($faviconUrl)
                            <img src="{{ $faviconUrl }}" alt="Favicon" class="mt-2 h-8 w-8 object-contain">
                        @endif
                        @error('favicon') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="pondok-label">Teks Footer</label>
                        <textarea wire:model="footer_text" rows="2" class="pondok-input"></textarea>
                    </div>
                    <div>
                        <label class="pondok-label">Judul SEO</label>
                        <input type="text" wire:model="seo_title" class="pondok-input">
                    </div>
                    <div>
                        <label class="pondok-label">Deskripsi SEO</label>
                        <textarea wire:model="seo_description" rows="2" class="pondok-input"></textarea>
                    </div>
                </div>
            </section>
        </div>

        {{-- BERANDA --}}
        <div @class(['space-y-6' => true, 'hidden' => $activeTab !== 'beranda'])>
            <section class="rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm sm:p-6">
                <h2 class="mb-4 font-display text-xl font-semibold text-pondok-900">Hero Beranda</h2>
                <div class="grid gap-4">
                    <div>
                        <label class="pondok-label">Judul</label>
                        <input type="text" wire:model="home_hero_title" class="pondok-input">
                    </div>
                    <div>
                        <label class="pondok-label">Subtitle</label>
                        <textarea wire:model="home_hero_subtitle" rows="3" class="pondok-input"></textarea>
                    </div>
                    <div>
                        <label class="pondok-label">Gambar background</label>
                        <input type="file" wire:model="home_hero" accept="image/*" class="mt-1.5 w-full text-sm">
                        @if ($homeHeroUrl)
                            <img src="{{ $homeHeroUrl }}" alt="Hero" class="mt-2 h-28 rounded-lg object-cover">
                        @endif
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="pondok-label">Tombol 1 — teks</label>
                            <input type="text" wire:model="home_cta1_label" class="pondok-input">
                        </div>
                        <div>
                            <label class="pondok-label">Tombol 1 — URL</label>
                            <input type="text" wire:model="home_cta1_url" class="pondok-input" placeholder="/profil">
                        </div>
                        <div>
                            <label class="pondok-label">Tombol 2 — teks</label>
                            <input type="text" wire:model="home_cta2_label" class="pondok-input">
                        </div>
                        <div>
                            <label class="pondok-label">Tombol 2 — URL</label>
                            <input type="text" wire:model="home_cta2_url" class="pondok-input" placeholder="/kontak">
                        </div>
                    </div>
                    <div>
                        <label class="pondok-label">Intro section Panca Jiwa (beranda)</label>
                        <textarea wire:model="home_panca_intro" rows="2" class="pondok-input"></textarea>
                    </div>
                </div>
            </section>

            <section class="rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm sm:p-6">
                <div class="mb-4 flex items-center justify-between gap-3">
                    <h2 class="font-display text-xl font-semibold text-pondok-900">Statistik</h2>
                    <button type="button" wire:click="addStat" class="admin-btn-secondary !py-2 text-xs">+ Tambah</button>
                </div>
                <div class="space-y-3">
                    @foreach ($stats as $index => $stat)
                        <div class="grid gap-3 rounded-lg border border-[var(--pondok-line)] p-3 md:grid-cols-[1fr_1fr_8rem_auto]">
                            <div>
                                <label class="text-xs font-semibold text-stone-500">Nilai</label>
                                <input type="text" wire:model="stats.{{ $index }}.value" class="pondok-input !mt-1" placeholder="1.250">
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-stone-500">Judul</label>
                                <input type="text" wire:model="stats.{{ $index }}.label" class="pondok-input !mt-1" placeholder="Santri">
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-stone-500">Ikon</label>
                                <select wire:model="stats.{{ $index }}.icon" class="pondok-input !mt-1">
                                    @foreach ($iconOptions as $icon)
                                        <option value="{{ $icon }}">{{ $icon }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-end">
                                <button type="button" wire:click="removeStat({{ $index }})" class="text-sm text-rose-600 underline">Hapus</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        {{-- PROFIL --}}
        <div @class(['space-y-6' => true, 'hidden' => $activeTab !== 'profil'])>
            <section class="rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm sm:p-6">
                <h2 class="mb-4 font-display text-xl font-semibold text-pondok-900">Hero & Foto</h2>
                <div class="grid gap-4 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label class="pondok-label">Subtitle hero profil</label>
                        <textarea wire:model="profil_hero_subtitle" rows="2" class="pondok-input"></textarea>
                    </div>
                    <div>
                        <label class="pondok-label">Gambar hero profil</label>
                        <input type="file" wire:model="profil_hero" accept="image/*" class="mt-1.5 w-full text-sm">
                        @if ($profilHeroUrl)
                            <img src="{{ $profilHeroUrl }}" alt="" class="mt-2 h-24 rounded-lg object-cover">
                        @endif
                    </div>
                    <div>
                        <label class="pondok-label">Foto pendiri / sejarah</label>
                        <input type="file" wire:model="profil_founder_photo" accept="image/*" class="mt-1.5 w-full text-sm">
                        @if ($founderUrl)
                            <img src="{{ $founderUrl }}" alt="" class="mt-2 h-24 rounded-lg object-cover">
                        @endif
                    </div>
                </div>
            </section>

            <section class="rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm sm:p-6">
                <h2 class="mb-4 font-display text-xl font-semibold text-pondok-900">Visi, Misi, Motto & Nilai</h2>
                <div class="space-y-4">
                    <div>
                        <label class="pondok-label">Visi</label>
                        <textarea wire:model="profil_visi" rows="3" class="pondok-input"></textarea>
                    </div>
                    <div>
                        <div class="mb-2 flex items-center justify-between">
                            <label class="pondok-label !mb-0">Misi</label>
                            <button type="button" wire:click="addMisi" class="text-xs font-semibold text-pondok-800 underline">+ Item misi</button>
                        </div>
                        <div class="space-y-2">
                            @foreach ($misi as $index => $item)
                                <div class="flex gap-2">
                                    <input type="text" wire:model="misi.{{ $index }}" class="pondok-input !mt-0" placeholder="Poin misi...">
                                    <button type="button" wire:click="removeMisi({{ $index }})" class="shrink-0 text-sm text-rose-600 underline">Hapus</button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <label class="pondok-label">Motto</label>
                        <input type="text" wire:model="profil_motto" class="pondok-input" placeholder="Motto pondok">
                    </div>
                    <div>
                        <label class="pondok-label">Nilai Pondok</label>
                        <textarea wire:model="profil_nilai" rows="3" class="pondok-input" placeholder="Ringkasan nilai-nilai pondok"></textarea>
                    </div>
                </div>
            </section>

            <section class="rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm sm:p-6">
                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="font-display text-xl font-semibold text-pondok-900">Panca Jiwa</h2>
                        <input type="text" wire:model="panca_section_title" class="pondok-input mt-2 max-w-sm" placeholder="Judul section">
                    </div>
                    <button type="button" wire:click="addPanca" class="admin-btn-secondary !py-2 text-xs">+ Tambah</button>
                </div>
                <div class="space-y-3">
                    @foreach ($panca_jiwa as $index => $item)
                        <div class="rounded-lg border border-[var(--pondok-line)] p-3">
                            <div class="grid gap-3 md:grid-cols-[1fr_8rem_auto]">
                                <div>
                                    <label class="text-xs font-semibold text-stone-500">Judul</label>
                                    <input type="text" wire:model="panca_jiwa.{{ $index }}.title" class="pondok-input !mt-1">
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-stone-500">Ikon</label>
                                    <select wire:model="panca_jiwa.{{ $index }}.icon" class="pondok-input !mt-1">
                                        @foreach ($iconOptions as $icon)
                                            <option value="{{ $icon }}">{{ $icon }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex items-end">
                                    <button type="button" wire:click="removePanca({{ $index }})" class="text-sm text-rose-600 underline">Hapus</button>
                                </div>
                            </div>
                            <div class="mt-2">
                                <label class="text-xs font-semibold text-stone-500">Deskripsi</label>
                                <textarea wire:model="panca_jiwa.{{ $index }}.description" rows="2" class="pondok-input !mt-1"></textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm sm:p-6">
                <h2 class="mb-4 font-display text-xl font-semibold text-pondok-900">Pengasuh</h2>
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="space-y-3">
                        <p class="text-sm font-semibold text-stone-600">Pengasuh 1</p>
                        <input type="text" wire:model="pengasuh_1_name" class="pondok-input" placeholder="Nama">
                        <input type="text" wire:model="pengasuh_1_title" class="pondok-input" placeholder="Jabatan">
                        <input type="file" wire:model="pengasuh_1_photo" accept="image/*" class="w-full text-sm">
                        @if ($pengasuh1Url)
                            <img src="{{ $pengasuh1Url }}" alt="" class="h-28 rounded-lg object-cover">
                        @endif
                    </div>
                    <div class="space-y-3">
                        <p class="text-sm font-semibold text-stone-600">Pengasuh 2</p>
                        <input type="text" wire:model="pengasuh_2_name" class="pondok-input" placeholder="Nama">
                        <input type="text" wire:model="pengasuh_2_title" class="pondok-input" placeholder="Jabatan">
                        <input type="file" wire:model="pengasuh_2_photo" accept="image/*" class="w-full text-sm">
                        @if ($pengasuh2Url)
                            <img src="{{ $pengasuh2Url }}" alt="" class="h-28 rounded-lg object-cover">
                        @endif
                    </div>
                </div>
            </section>
        </div>

        {{-- KONTAK --}}
        <div @class(['space-y-6' => true, 'hidden' => $activeTab !== 'kontak'])>
            <section class="rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm sm:p-6">
                <h2 class="mb-4 font-display text-xl font-semibold text-pondok-900">Kontak & Media Sosial</h2>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="pondok-label">Telepon</label>
                        <input type="text" wire:model="phone" class="pondok-input">
                    </div>
                    <div>
                        <label class="pondok-label">WhatsApp</label>
                        <input type="text" wire:model="whatsapp" class="pondok-input">
                    </div>
                    <div>
                        <label class="pondok-label">Email</label>
                        <input type="email" wire:model="email" class="pondok-input">
                    </div>
                    <div>
                        <label class="pondok-label">Alamat</label>
                        <textarea wire:model="address" rows="2" class="pondok-input"></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="pondok-label">Embed Maps</label>
                        <textarea wire:model="maps_embed" rows="3" class="pondok-input font-mono text-sm" placeholder="Tempel iframe Google Maps"></textarea>
                    </div>
                    <div>
                        <label class="pondok-label">Facebook</label>
                        <input type="url" wire:model="facebook" class="pondok-input">
                    </div>
                    <div>
                        <label class="pondok-label">Instagram</label>
                        <input type="url" wire:model="instagram" class="pondok-input">
                    </div>
                    <div>
                        <label class="pondok-label">YouTube</label>
                        <input type="url" wire:model="youtube" class="pondok-input">
                    </div>
                </div>
            </section>
        </div>

        <div class="flex justify-end border-t border-[var(--pondok-line)] pt-4">
            <button type="submit" class="admin-btn-primary" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="save">Simpan Pengaturan</span>
                <span wire:loading wire:target="save">Menyimpan...</span>
            </button>
        </div>
    </form>
</div>
