<?php

namespace Tests\Feature\Api\Newsletter;

use Tests\TestCase;
use Newsletter;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;

class NewsletterControllerTest extends TestCase
{
    use RefreshDatabase,  CanLogin;

    public function guest_user_can_subscribe_to_newsletter()
    {
        //$this->withoutExceptionHandling();
        $this->login('api');
        Newsletter::shouldReceive('subscribePending')
            ->once()
            ->with('prova@gmail.com')
            ->andReturn('value'); // Return some value to avoid 422 errors
        $response = $this->json('POST', '/api/v1/newsletter', ['email' => 'prova@gmail.com']);
        $response->assertSuccessful();
    }
    /**
     * @test
     * @group newsletter
     */
    public function email_is_required()
    {
        $this->login('api');
        $response = $this->json('POST', '/api/v1/newsletter', ['email' => null]);
        $response->assertStatus(422);
        $response = $this->json('POST', '/api/v1/newsletter', ['email' => 'invalidemail']);
        $response->assertStatus(422);
    }
}
