<?php

namespace App\Support;

trait WithSearch
{
    public string $search = '';

    public function updatingSearch(): void
    {
        if (property_exists($this, 'resetPage') || method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }
}
