<?php

namespace App\Support;

trait WithToast
{
    protected function toastSuccess(string $message, bool $flash = true): void
    {
        $this->toast($message, 'success', $flash);
    }

    protected function toastError(string $message, bool $flash = true): void
    {
        $this->toast($message, 'error', $flash);
    }

    protected function toast(string $message, string $type = 'success', bool $flash = true): void
    {
        if ($flash) {
            session()->flash($type === 'error' ? 'error' : 'success', $message);
        }

        $this->dispatch('toast', type: $type, message: $message);
    }
}
