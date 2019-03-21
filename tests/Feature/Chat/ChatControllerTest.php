<?php

namespace Tests\Feature\Chat;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;

class ChatControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;
    /** @test */
    public function chat_user_can_see_chats()
    {
        $this->withoutExceptionHandling();
        initialize_sample_chat_channels();
        $this->loginAsSuperAdmin('web', get_admin_user());

        $response = $this->get('/chat');

        $response->assertSuccessful();
        $response->assertViewIs('chat.index');
        $response->assertViewHas('channels', function ($channels) {
            return is_array($channels->toArray()) &&
                $channels[0]->value === 'Pepe Pardo Jeans';
        });
    }
}
