<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Group;
use App\Models\User;
use App\Models\Permission;


class PermissionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $groups = Group::factory()->count(5)->create();
        $permissions = Permission::factory()->count(5)->create();
        $user = User::factory()->create();

        $group_to_user = $groups[array_rand($groups->toArray())];
        $permission_to_user = $permissions[array_rand($permissions->toArray())];
        $permission_to_group = $permissions[array_rand($permissions->toArray())];


        $user->groups()->attach($group_to_user->id);
        $user->permissions()->attach($permission_to_user->id);
        $group_to_user->permissions()->attach($permission_to_group->id);

        $this->assertTrue($user->hasPermission($permission_to_group->key));
        $this->assertTrue($user->hasPermission($permission_to_user->key));

    }
}
