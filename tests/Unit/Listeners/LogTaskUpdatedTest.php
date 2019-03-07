<?php

namespace Tests\Unit\Listeners;

use App\Log;
use App\Task;
use App\User;
use Tests\TestCase;
use App\Listeners\Tasks\LogTaskUpdated;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogTaskUpdatedTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * @return void
     */
    public function a_task_updated_log_has_been_created()
    {
        //prepare
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);

        $oldTask = clone $task;  //$task->map();

        $task->name = 'Comprar pa al supermercat';
        $task->save();
        
        $listener = new LogTaskUpdated();
        //execute
        $listener->handle($event = new \App\Events\Tasks\TaskUpdated($task, $oldTask));

        //Test log is inserted
        $log  = Log::where('loggable_id', $task->id)->first();

        //assert
        $this->assertEquals($log->text, "S'ha modificat la tasca '{$task->name}'");
        $this->assertEquals($log->action_type, 'modificar');
        $this->assertEquals($log->module_type, 'Tasques');
        $this->assertEquals($log->user_id, $task->user_id);
        $this->assertEquals($log->old_value, $event->oldTask);
        $this->assertEquals($log->new_value, $event->task); //how TODO this? old vs new value Task
        $this->assertEquals($log->loggable_id, $task->id);
        $this->assertEquals($log->loggable_type, 'App\Task');
        $this->assertEquals($log->icon, 'edit');
        $this->assertEquals($log->color, 'blue');
    }
}
