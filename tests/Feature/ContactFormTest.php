<?php

namespace Tests\Feature;

use App\Livewire\Web\ContactForm;
use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_submit_contact_form(): void
    {
        Livewire::test(ContactForm::class)
            ->set('name', 'Budi Santoso')
            ->set('email', 'budi@example.com')
            ->set('phone', '081234567890')
            ->set('subject', 'Informasi Pendaftaran')
            ->set('message', 'Assalamu\'alaikum, saya ingin bertanya tentang pendaftaran.')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('submitted', true)
            ->assertSee('Terima kasih! Pesan Anda telah berhasil dikirim');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081234567890',
            'subject' => 'Informasi Pendaftaran',
            'is_read' => false,
        ]);

        $this->assertSame(1, ContactMessage::query()->count());
    }
}
