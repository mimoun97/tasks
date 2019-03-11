<?php

namespace Tests\Unit\Listeners;

use App\Task;
use App\User;
use Tests\TestCase;
use App\Mail\Tasks\TaskStored;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendMailTaskStoredTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function send_a_stored_task_email()
    {
        $this->withExceptionHandling();
        // 1 Preparar
        Mail::fake();
        $listener = new \App\Listeners\Tasks\SendMailTaskStored;
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);

        // Executar
        Mail::assertNotSent(TaskStored::class);

        $listener->handle(new \App\Events\Tasks\TaskStored($task));

        // 3 ASSERT
        Mail::assertSent(TaskStored::class, function ($mail) use ($task, $user) {
            return  $mail->task->is($task) &&
                $mail->hasTo($user->email) &&
                $mail->hasCc(config('tasks.manager_email'));
        });
    }
}
