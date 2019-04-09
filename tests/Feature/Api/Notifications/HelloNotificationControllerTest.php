<?php

namespace Tests\Feature\Api\Notifications;

use Tests\TestCase;
use Tests\Feature\Traits\CanLogin;
use App\Notifications\HelloNotification;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HelloNotificationControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     * @group notifications
     */
    public function user_can_send_hello_notification_to_himself()
    {
        $this->withoutExceptionHandling();
        $user = $this->login('api');
        Notification::fake();
        $response = $this->json('POST', '/api/v1/notifications/hello');
        //dd($response);
        $response->assertSuccessful();
        Notification::assertSentTo($user, HelloNotification::class);
    }
    /**
     * @test
     * @group notifications
     */
    public function guest_user_can_send_hello_notification_to_himself()
    {
        Notification::fake();
        $response = $this->json('POST', '/api/v1/notifications/hello');
        $response->assertStatus(401);
        Notification::assertNothingSent();
    }
}
