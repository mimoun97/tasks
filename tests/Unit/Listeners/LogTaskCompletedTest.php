<?php

namespace Tests\Unit\Listeners;

use App\Log;
use App\Task;
use App\User;
use Tests\TestCase;
use App\Listeners\Tasks\LogTaskCompleted;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogTaskCompletedTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * @return void
     */
    public function a_task_completed_log_has_been_created()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'completed' => true,
            'user_id' => $user->id
        ]);

        $listener = new LogTaskCompleted();
        $listener->handle(new \App\Events\Tasks\TaskCompleted($task));

        //        // Test log is inserted
        $log  = Log::where('loggable_id', $task->id)->first();
        $this->assertEquals($log->text, "S'ha marcat com a completada la tasca '{$task->name}'");
        $this->assertEquals($log->action_type, 'completar');
        $this->assertEquals($log->module_type, 'Tasques');
        $this->assertEquals($log->user_id, $task->user_id);
        $this->assertEquals($log->old_value, true);
        $this->assertEquals($log->new_value, 0);
        $this->assertEquals($log->loggable_id, $task->id);
        $this->assertEquals($log->loggable_type, 'App\Task');
        $this->assertEquals($log->icon, 'lock');
        $this->assertEquals($log->color, 'indigo');
        $this->assertEquals($log->time, $log->created_at);
    }
}
