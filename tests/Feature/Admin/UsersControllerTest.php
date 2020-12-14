<?php

namespace Tests\Feature\Admin;

use CodeFlix\Models\User;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersControllerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIfUserDoesntSeeAdminUserList()
    {
        $this->get(route('admin.users.index'))
            ->assertRedirect(route('admin.login'))
            ->assertStatus(302);
    }

    public function testIfUserSeeUserList()
    {
        Model::unguard();
        $user = factory(User::class)
            ->states('admin')
            ->create(['verified' => true]);

        $this->actingAs($user)->get(route('admin.users.index'))
            ->assertSee("Listagem de Usuários");
    }
}
