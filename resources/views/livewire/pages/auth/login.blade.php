<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] #[Title('Masuk')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        Session::flash('success', 'Berhasil masuk.');

        $this->redirectIntended(default: route('admin.dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="mb-8">
        <h2 class="font-display text-3xl font-semibold tracking-wide text-pondok-900">Masuk</h2>
        <p class="mt-2 text-sm text-[var(--pondok-muted)]">
            Gunakan akun admin atau editor untuk mengelola konten website.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="space-y-5">
        <div>
            <label for="email" class="pondok-label">Email</label>
            <input
                wire:model="form.email"
                id="email"
                type="email"
                name="email"
                required
                autofocus
                autocomplete="username"
                placeholder="ustadz@pondok.com"
                class="pondok-input"
            >
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between gap-3">
                <label for="password" class="pondok-label">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-pondok-800 hover:underline" wire:navigate>
                        Lupa password?
                    </a>
                @endif
            </div>
            <input
                wire:model="form.password"
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="••••••••"
                class="pondok-input"
            >
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div>
            <label for="remember" class="inline-flex items-center gap-2 text-sm text-stone-600">
                <input
                    wire:model="form.remember"
                    id="remember"
                    type="checkbox"
                    name="remember"
                    class="rounded border-[var(--pondok-line)] text-pondok-800 shadow-none focus:ring-pondok-700"
                >
                Ingat saya
            </label>
        </div>

        <button type="submit" class="admin-btn-primary w-full !py-3">
            Masuk ke Panel
        </button>
    </form>
</div>
