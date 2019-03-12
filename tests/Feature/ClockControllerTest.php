<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;

class ClockControllerTest extends TestCase
{
    use CanLogin, RefreshDatabase;
    /**
     * @test
     */
    public function guest_user_cannot_index_clock()
    {
        $response = $this->get('/clock');
        $response->assertRedirect('/login');
    }
    /**
     * @test
     * @return void
     */
    public function logged_user_can_index_clock()
    {
        $this->login();

        $response = $this->get('/clock');

        $response->assertSuccessful();

        $response->assertViewIs('clock.index');
    }
}
