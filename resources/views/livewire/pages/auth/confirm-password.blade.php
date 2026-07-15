<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] #[Title('Konfirmasi Password')] class extends Component
{
    public string $password = '';

    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="mb-8">
        <h2 class="font-display text-3xl font-semibold tracking-wide text-pondok-900">Konfirmasi password</h2>
        <p class="mt-2 text-sm text-[var(--pondok-muted)]">
            Area aman. Konfirmasikan password Anda sebelum melanjutkan.
        </p>
    </div>

    <form wire:submit="confirmPassword" class="space-y-5">
        <div>
            <label for="password" class="pondok-label">Password</label>
            <input
                wire:model="password"
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                class="pondok-input"
            >
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <button type="submit" class="admin-btn-primary w-full !py-3">
            Konfirmasi
        </button>
    </form>
</div>
