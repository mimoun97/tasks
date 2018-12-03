<?php

namespace Tests\Feature;

use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasquesControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    //Accés url /tasques

    // 1) superadmin

    /**
     * @test
     */
    public function guest_user_cannot_index_tasques()
    {
        $response = $this->get('/tasques');
        $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function regular_user_cannot_index_tasques()
    {
        //$this->withoutExceptionHandling();
        $this->login();
        $response = $this->get('/tasques');
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function superadmin_user_can_index_tasques()
    {
        //$this->withoutExceptionHandling();
        $this->loginAsSuperAdmin();
        $response = $this->get('/tasques');
        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function taskmanager_user_can_index_tasques()
    {
        //$this->withoutExceptionHandling();
        $this->loginAsTaskManager();
        $response = $this->get('/tasques');
        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function owner_tasks_user_can_index_tasques()
    {
        $this->withoutExceptionHandling();
        $this->loginAsTasksUser();
        $response = $this->get('/tasques');
        $response->assertSuccessful();
    }
}
