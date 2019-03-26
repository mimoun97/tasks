<?php

namespace Tests\Unit\Listeners;

use App\Task;
use App\User;
use Tests\TestCase;
use App\Notifications\Tasks\TaskStored;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendTaskStoredNotificationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function send_task_stored_notification()
    {
        $this->withExceptionHandling();
        // 1 Preparar
        $listener = new \App\Listeners\Tasks\SendTaskStoredNotification;
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);

        // Executar
        Notification::fake();
        Notification::assertNothingSent();

        $listener->handle(new \App\Events\Tasks\TaskStored($task));

        // 3 ASSERT
        Notification::assertSentTo(
            $user,
            TaskStored::class,
            function ($notification, $channels) use ($task) {
                //dd("hola!");
                return $notification->task->id === $task->id;
            }
        );
    }
}
