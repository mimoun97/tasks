<?php

namespace Tests\Unit\Listeners;

use App\Task;
use App\User;
use Tests\TestCase;
use App\Mail\Tasks\TaskCompleted;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendMailTaskCompletedTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function send_a_completed_task_email()
    {
        $this->withExceptionHandling();
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);
        
        // Executar
        Mail::fake();
        $listener = new \App\Listeners\Tasks\SendMailTaskCompleted();
        $listener->handle(new \App\Events\Tasks\TaskCompleted($task));
        // 3 ASSERT
        Mail::assertSent(TaskCompleted::class, function ($mail) use ($task, $user) {
            return  $mail->task->is($task) &&
                $mail->hasTo($user->email) &&
                $mail->hasCc(config('tasks.manager_email'));
        });
    }
}
