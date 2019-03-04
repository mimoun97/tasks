<?php

namespace Tests\Unit\Listeners;

use App\Log;
use App\Task;
use App\User;
use Tests\TestCase;
use App\Listeners\Tasks\LogTaskDestroyed;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogTaskDestroyedTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * @return void
     */
    public function a_task_destroyed_log_has_been_created()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);

        $listener = new LogTaskDestroyed();
        $listener->handle(new \App\Events\Tasks\TaskDestroyed($task));

        //Test log is inserted
        $log  = Log::where('loggable_id', $task->id)->first();
        $this->assertEquals($log->text, "S'ha eliminat la tasca '{$task->name}'");
        $this->assertEquals($log->action_type, 'eliminar');
        $this->assertEquals($log->module_type, 'Tasques');
        $this->assertEquals($log->user_id, $task->user_id);
        $this->assertEquals($log->old_value, $task);
        $this->assertEquals($log->new_value, null);
        $this->assertEquals($log->loggable_id, $task->id);
        $this->assertEquals($log->loggable_type, 'App\Task');
        $this->assertEquals($log->icon, 'delete');
        $this->assertEquals($log->color, 'red');
    }
}
