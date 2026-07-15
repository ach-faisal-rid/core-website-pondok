<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] #[Title('Verifikasi Email')] class extends Component
{
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div>
    <div class="mb-8">
        <h2 class="font-display text-3xl font-semibold tracking-wide text-pondok-900">Verifikasi email</h2>
        <p class="mt-2 text-sm leading-relaxed text-[var(--pondok-muted)]">
            Terima kasih. Sebelum mulai, verifikasi alamat email Anda melalui tautan yang kami kirim.
            Jika belum menerima email, kami dapat mengirim ulang.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
            Tautan verifikasi baru telah dikirim ke email Anda.
        </div>
    @endif

    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <button type="button" wire:click="sendVerification" class="admin-btn-primary">
            Kirim ulang email verifikasi
        </button>

        <button type="button" wire:click="logout" class="text-sm font-medium text-pondok-800 hover:underline">
            Keluar
        </button>
    </div>
</div>
