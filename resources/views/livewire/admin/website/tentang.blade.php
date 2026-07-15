<div>
    <x-admin.page-header title="Tentang Pondok" description="Identitas, sejarah singkat, dan gambar halaman profil." />
    <form wire:submit="save" class="max-w-3xl space-y-4 rounded-xl border border-[var(--pondok-line)] bg-white p-5 shadow-sm sm:p-6">
        <div><label class="pondok-label">Judul section</label><input type="text" wire:model="tentang_title" class="pondok-input"></div>
        <div><label class="pondok-label">Subtitle hero profil</label><textarea wire:model="profil_hero_subtitle" rows="2" class="pondok-input"></textarea></div>
        <div><label class="pondok-label">Ringkasan tentang</label><textarea wire:model="tentang_body" rows="6" class="pondok-input" placeholder="Teks tentang pondok (boleh HTML sederhana)"></textarea></div>
        <div class="grid gap-4 md:grid-cols-2">
            <div><label class="pondok-label">Gambar hero</label><input type="file" wire:model="profil_hero" accept="image/*" class="mt-1.5 w-full text-sm">@if($heroUrl)<img src="{{ $heroUrl }}" class="mt-2 h-24 rounded-lg object-cover">@endif</div>
            <div><label class="pondok-label">Foto pendiri</label><input type="file" wire:model="profil_founder_photo" accept="image/*" class="mt-1.5 w-full text-sm">@if($founderUrl)<img src="{{ $founderUrl }}" class="mt-2 h-24 rounded-lg object-cover">@endif</div>
        </div>
        <p class="text-xs text-stone-500">Detail sejarah panjang tetap bisa dikelola di menu Konten (slug: sejarah).</p>
        <button type="submit" class="admin-btn-primary">Simpan</button>
    </form>
</div>
