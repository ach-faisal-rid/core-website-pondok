<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use App\Support\WithSearch;
use App\Support\WithSorting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Support\WithToast;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Pengguna')]
class Index extends Component
{
    use WithToast;

    use WithPagination;
    use WithSearch;
    use WithSorting;

    public function mount(): void
    {
        $this->authorize('viewAny', User::class);
    }

    public function delete(int $id): void
    {
        $user = User::query()->findOrFail($id);
        $this->authorize('delete', $user);
        $user->delete();

        $this->toastSuccess('Pengguna berhasil dihapus.');
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy($this->sortField ?: 'name', $this->sortDirection ?: 'asc')
            ->paginate(15);

        return view('livewire.admin.users.index', compact('users'));
    }
}
