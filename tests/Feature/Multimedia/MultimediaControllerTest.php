<?php

namespace Tests\Feature\Multimedia;

use Tests\TestCase;
use Tests\Feature\Traits\CanLogin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MultimediaControllerTest extends TestCase
{
    use CanLogin, RefreshDatabase;

    /** @test */
    public function logged_user_can_see_multimedia()
    {
        $this->withoutExceptionHandling();

        $this->login();

        $response = $this->get('/multimedia');

        $response->assertSuccessful();
        $response->assertViewIs('multimedia.index');
    }
}
