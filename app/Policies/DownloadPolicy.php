<?php

namespace App\Policies;

use App\Models\Download;
use App\Models\User;

class DownloadPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Download $download): bool
    {
        return true;
    }

    public function delete(User $user, Download $download): bool
    {
        return true;
    }
}
