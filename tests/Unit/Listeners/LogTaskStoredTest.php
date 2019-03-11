<?php

namespace Tests\Unit\Listeners;

use App\Log;
use App\Task;
use App\User;
use Tests\TestCase;
use App\Listeners\Tasks\LogTaskStored;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogTaskStoredTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * @return void
     */
    public function a_task_stored_log_has_been_created()
    {
        // prepare
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'completed' => true,
            'user_id' => $user->id
        ]);

        $listener = new LogTaskStored();

        //execute
        $listener->handle(new \App\Events\Tasks\TaskStored($task));

        //        // Test log is inserted
        $log  = Log::where('loggable_id', $task->id)->first();

        //assert
        $this->assertEquals($log->text, "S'ha creat la tasca '{$task->name}'");
        $this->assertEquals($log->action_type, 'crear');
        $this->assertEquals($log->module_type, 'Tasques');
        $this->assertEquals($log->user_id, $task->user_id);
        $this->assertEquals($log->old_value, null);
        $this->assertEquals($log->new_value, $task);
        $this->assertEquals($log->loggable_id, $task->id);
        $this->assertEquals($log->loggable_type, 'App\Task');
        $this->assertEquals($log->icon, 'visibility');
        $this->assertEquals($log->color, 'orange');
        $this->assertEquals($log->time, $log->created_at);
    }
}
