<div>
    @if ($submitted)
        <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-4 text-emerald-900" role="status">
            Terima kasih! Pesan Anda telah berhasil dikirim. Kami akan menghubungi Anda segera.
        </div>
    @else
        <form wire:submit="submit" class="space-y-5">
            <div class="absolute -left-[9999px] h-0 w-0 overflow-hidden" aria-hidden="true">
                <label for="website">Website</label>
                <input id="website" type="text" wire:model="website" tabindex="-1" autocomplete="off">
            </div>

            <div>
                <label for="name" class="pondok-label">Nama Lengkap</label>
                <input
                    id="name"
                    type="text"
                    wire:model="name"
                    class="pondok-input"
                    placeholder="Masukkan nama Anda"
                    required
                >
                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="pondok-label">Alamat Email</label>
                <input
                    id="email"
                    type="email"
                    wire:model="email"
                    class="pondok-input"
                    placeholder="email@contoh.com"
                    required
                >
                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="phone" class="pondok-label">Telepon / WhatsApp</label>
                <input
                    id="phone"
                    type="text"
                    wire:model="phone"
                    class="pondok-input"
                    placeholder="+62 ..."
                >
                @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="subject" class="pondok-label">Subjek</label>
                <select id="subject" wire:model="subject" class="pondok-input">
                    @foreach ($subjects as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
                @error('subject') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="message" class="pondok-label">Pesan Anda</label>
                <textarea
                    id="message"
                    wire:model="message"
                    rows="5"
                    class="pondok-input"
                    placeholder="Tuliskan pesan Anda secara detail..."
                    required
                ></textarea>
                @error('message') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-stretch pt-1 sm:justify-end">
                <button
                    type="submit"
                    class="inline-flex w-full items-center justify-center rounded-lg bg-pondok-800 px-6 py-3 text-sm font-semibold text-white transition hover:bg-pondok-900 disabled:opacity-60 sm:w-auto sm:py-2.5"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove wire:target="submit">Kirim Pesan</span>
                    <span wire:loading wire:target="submit">Mengirim...</span>
                </button>
            </div>
        </form>
    @endif
</div>
