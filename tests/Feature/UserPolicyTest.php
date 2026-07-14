<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class UserPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_editor_cannot_view_any_user(): void
    {
        $editor = User::factory()->editor()->create();

        $this->assertFalse(Gate::forUser($editor)->allows('viewAny', User::class));
    }

    public function test_admin_can_view_any_user(): void
    {
        $admin = User::factory()->admin()->create();

        $this->assertTrue(Gate::forUser($admin)->allows('viewAny', User::class));
    }
}
