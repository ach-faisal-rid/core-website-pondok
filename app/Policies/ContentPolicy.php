<?php

namespace App\Policies;

use App\Models\Content;
use App\Models\User;

class ContentPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Content $content): bool
    {
        return true;
    }

    public function delete(User $user, Content $content): bool
    {
        return true;
    }
}
