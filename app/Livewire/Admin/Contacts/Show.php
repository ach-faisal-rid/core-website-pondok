<?php

namespace App\Livewire\Admin\Contacts;

use App\Models\ContactMessage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Support\WithToast;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Detail Pesan')]
class Show extends Component
{
    use WithToast;

    public ContactMessage $contactMessage;

    public function mount(ContactMessage $contactMessage): void
    {
        $this->authorize('view', $contactMessage);
        $this->contactMessage = $contactMessage;

        if (! $contactMessage->is_read) {
            $this->authorize('update', $contactMessage);
            $contactMessage->update(['is_read' => true]);
            $this->contactMessage->refresh();
        }
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->contactMessage);
        $this->contactMessage->delete();

        $this->toastSuccess('Pesan berhasil dihapus.');
        $this->redirect(route('admin.contacts.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.contacts.show');
    }
}
