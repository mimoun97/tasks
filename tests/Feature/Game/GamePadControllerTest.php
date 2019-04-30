<?php

namespace Tests\Feature\Game;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;

class GamePadControllerTest extends TestCase
{
    use CanLogin, RefreshDatabase;
    /** @test */
    public function logged_user_can_see_game_pad_game()
    {
        $this->withoutExceptionHandling();


        $this->loginAsSuperAdmin('web');

        $response = $this->get('/gamepad');

        $response->assertSuccessful();
        $response->assertViewIs('gamepad.index');
    }
}
