<?php

namespace App\Livewire\Admin\Website;

use App\Actions\UploadMediaAction;
use App\Livewire\Admin\Website\Concerns\AuthorizesWebsiteAdmin;
use App\Models\OrganizationMember;
use App\Support\WithToast;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
#[Title('Struktur Organisasi')]
class Struktur extends Component
{
    use AuthorizesWebsiteAdmin;
    use WithFileUploads;
    use WithToast;

    public string $name = '';

    public string $title = '';

    public int $sort_order = 0;

    public $photo;

    public ?int $editingId = null;

    public function mount(): void
    {
        $this->authorizeWebsite();
    }

    public function edit(int $id): void
    {
        $member = OrganizationMember::query()->findOrFail($id);
        $this->authorize('update', $member);
        $this->editingId = $member->id;
        $this->name = $member->name;
        $this->title = (string) $member->title;
        $this->sort_order = $member->sort_order;
        $this->photo = null;
    }

    public function cancelEdit(): void
    {
        $this->reset(['name', 'title', 'sort_order', 'photo', 'editingId']);
    }

    public function save(UploadMediaAction $upload): void
    {
        $this->authorize('create', OrganizationMember::class);

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['integer', 'min:0', 'max:9999'],
            'photo' => ['nullable', 'image', 'max:4096'],
        ]);

        $data = [
            'name' => $this->name,
            'title' => $this->title,
            'sort_order' => $this->sort_order,
        ];

        if ($this->editingId) {
            $member = OrganizationMember::query()->findOrFail($this->editingId);
            $this->authorize('update', $member);
            if ($this->photo) {
                $upload->delete($member->photo);
                $data['photo'] = $upload->execute($this->photo, 'organization');
            }
            $member->update($data);
            $this->toastSuccess('Anggota struktur diperbarui.');
        } else {
            if ($this->photo) {
                $data['photo'] = $upload->execute($this->photo, 'organization');
            }
            OrganizationMember::query()->create($data);
            $this->toastSuccess('Anggota struktur ditambahkan.');
        }

        $this->cancelEdit();
    }

    public function delete(int $id): void
    {
        $member = OrganizationMember::query()->findOrFail($id);
        $this->authorize('delete', $member);
        app(UploadMediaAction::class)->delete($member->photo);
        $member->delete();
        $this->toastSuccess('Anggota dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.website.struktur', [
            'members' => OrganizationMember::query()->orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }
}
