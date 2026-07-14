<?php

namespace App\Policies;

use App\Models\HelpArticle;
use App\Models\User;

class HelpArticlePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, HelpArticle $helpArticle): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, HelpArticle $helpArticle): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, HelpArticle $helpArticle): bool
    {
        return $user->isAdmin();
    }
}
