<?php

namespace App\Livewire\Admin\Contacts;

use App\Models\ContactMessage;
use App\Support\WithSearch;
use App\Support\WithSorting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Support\WithToast;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Pesan Kontak')]
class Index extends Component
{
    use WithToast;

    use WithPagination;
    use WithSearch;
    use WithSorting;

    public function mount(): void
    {
        $this->authorize('viewAny', ContactMessage::class);
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
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.contacts.index', compact('messages'));
    }
}
