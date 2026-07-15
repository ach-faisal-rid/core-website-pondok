<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] #[Title('Lupa Password')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div>
    <div class="mb-8">
        <h2 class="font-display text-3xl font-semibold tracking-wide text-pondok-900">Lupa password?</h2>
        <p class="mt-2 text-sm leading-relaxed text-[var(--pondok-muted)]">
            Tidak masalah. Masukkan email akun Anda, kami akan mengirim tautan untuk mengatur ulang password.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="space-y-5">
        <div>
            <label for="email" class="pondok-label">Email</label>
            <input
                wire:model="email"
                id="email"
                type="email"
                name="email"
                required
                autofocus
                placeholder="nama@contoh.com"
                class="pondok-input"
            >
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <button type="submit" class="admin-btn-primary w-full !py-3">
            Kirim tautan reset
        </button>

        <p class="text-center text-sm text-stone-500">
            <a href="{{ route('login') }}" class="font-medium text-pondok-800 hover:underline" wire:navigate>
                Kembali ke halaman masuk
            </a>
        </p>
    </form>
</div>
