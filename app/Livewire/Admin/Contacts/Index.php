<?php

namespace App\Livewire\Admin\Contacts;

use App\Models\ContactMessage;
use App\Support\WithSearch;
use App\Support\WithSorting;
use App\Support\WithToast;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Pesan Kontak')]
class Index extends Component
{
    use WithPagination;
    use WithSearch;
    use WithSorting;
    use WithToast;

    public string $statusFilter = '';

    public function mount(): void
    {
        $this->authorize('viewAny', ContactMessage::class);
        $this->sortField = 'created_at';
        $this->sortDirection = 'desc';
    }

    public function updatedStatusFilter(): void
    {
        $this->resetPage();
    }

    public function markRead(int $id): void
    {
        $message = ContactMessage::query()->findOrFail($id);
        $this->authorize('update', $message);
        $message->update(['is_read' => true]);

        $this->toastSuccess('Pesan ditandai sudah dibaca.');
    }

    public function delete(int $id): void
    {
        $message = ContactMessage::query()->findOrFail($id);
        $this->authorize('delete', $message);
        $message->delete();

        $this->toastSuccess('Pesan berhasil dihapus.');
    }

    public function render()
    {
        $messages = ContactMessage::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%')
                        ->orWhere('subject', 'like', '%'.$this->search.'%')
                        ->orWhere('message', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->statusFilter === 'unread', fn ($query) => $query->where('is_read', false))
            ->when($this->statusFilter === 'read', fn ($query) => $query->where('is_read', true))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.contacts.index', [
            'messages' => $messages,
            'unreadCount' => ContactMessage::query()->where('is_read', false)->count(),
        ]);
    }
}
