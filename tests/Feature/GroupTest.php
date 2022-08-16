<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Group;
use App\Models\User;
class GroupTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */



     public function test_user_belong_to_group(): void{
        $groups_no = Group::factory()->count(5)->create();
        $groups_ok = Group::factory()->count(5)->create();
        $user = User::factory()->create();
        $user->groups()->attach($groups_ok->pluck('id')->toArray());

        $user_group_ids = $user->groups->pluck('id')->toArray();

        $this->assertNotContains($groups_no[0]->id, $user_group_ids);
        $this->assertContains($groups_ok[2]->id, $user_group_ids);
    }
}
