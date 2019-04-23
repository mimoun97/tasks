<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use Tests\Feature\Traits\CanLogin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersControllerTest extends TestCase
{
    use CanLogin, RefreshDatabase;

    /**
     * @test
     */
    public function guest_user_cannot_index_users_list()
    {
        $response = $this->get('/users');
        $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function regular_user_cannot_index_users_list()
    {
        //$this->withoutExceptionHandling();
        $this->login();
        $response = $this->get('/users');
        $response->assertStatus(403);
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function superadmin_user_can_list_users()
    {
        $this->withoutExceptionHandling();

        $this->loginAsSuperAdmin();

        $response = $this->get('/users');
        $response->assertSuccessful();
        $response->assertViewIs('users.index');
    }
}
