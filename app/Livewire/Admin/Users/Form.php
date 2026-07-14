<?php

namespace App\Livewire\Admin\Users;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Support\WithToast;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Form Pengguna')]
class Form extends Component
{
    use WithToast;

    public ?User $user = null;

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public string $role = 'editor';

    public function mount(?User $user = null): void
    {
        if ($user?->exists) {
            $this->authorize('update', $user);
            $this->user = $user;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->role->value;
        } else {
            $this->authorize('create', User::class);
            $this->user = null;
        }
    }

    public function save(): void
    {
        if ($this->user) {
            $this->authorize('update', $this->user);
        } else {
            $this->authorize('create', User::class);
        }

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user?->id)],
            'role' => ['required', Rule::enum(UserRole::class)],
        ];

        if ($this->user === null) {
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        } else {
            $rules['password'] = ['nullable', 'confirmed', Password::defaults()];
        }

        $validated = $this->validate($rules);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => UserRole::from($validated['role']),
        ];

        if (! empty($validated['password'])) {
            $data['password'] = $validated['password'];
        }

        if ($this->user) {
            $this->user->update($data);
            $this->toastSuccess('Pengguna berhasil diperbarui.');
        } else {
            User::query()->create($data);
            $this->toastSuccess('Pengguna berhasil ditambahkan.');
        }

        $this->redirect(route('admin.users.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.users.form', [
            'roles' => UserRole::cases(),
        ]);
    }
}
