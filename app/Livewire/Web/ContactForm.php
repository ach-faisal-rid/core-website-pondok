<?php

namespace App\Livewire\Web;

use App\Models\ContactMessage;
use App\Support\WithToast;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ContactForm extends Component
{
    use WithToast;

    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $subject = 'Informasi Pendaftaran';

    public string $message = '';

    public string $website = '';

    public bool $submitted = false;

    /** @var list<string> */
    public array $subjects = [
        'Informasi Pendaftaran',
        'Informasi Program',
        'Kunjungan',
        'Lainnya',
    ];

    public function submit(): void
    {
        if ($this->website !== '') {
            $this->submitted = true;
            $this->reset(['name', 'email', 'phone', 'message', 'website']);
            $this->subject = 'Informasi Pendaftaran';

            return;
        }

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['required', 'string', Rule::in($this->subjects)],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $executed = RateLimiter::attempt(
            'contact-form:'.request()->ip(),
            5,
            function () use ($validated) {
                ContactMessage::query()->create([
                    ...$validated,
                    'is_read' => false,
                ]);
            },
            60
        );

        if (! $executed) {
            $this->toastError('Terlalu banyak percobaan. Silakan coba lagi dalam satu menit.', flash: false);
            $this->addError('email', 'Terlalu banyak percobaan. Silakan coba lagi dalam satu menit.');

            return;
        }

        $this->submitted = true;
        $this->reset(['name', 'email', 'phone', 'message', 'website']);
        $this->subject = 'Informasi Pendaftaran';
        $this->toastSuccess('Pesan Anda berhasil dikirim. Terima kasih.', flash: false);
    }

    public function render()
    {
        return view('livewire.web.contact-form');
    }
}
