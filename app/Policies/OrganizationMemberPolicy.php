<?php

namespace App\Policies;

use App\Models\OrganizationMember;
use App\Models\User;

class OrganizationMemberPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, OrganizationMember $organizationMember): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, OrganizationMember $organizationMember): bool
    {
        return $user->isAdmin();
    }
}
