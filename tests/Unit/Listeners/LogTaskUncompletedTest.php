<?php

namespace Tests\Unit\Listeners;

use App\Listeners\LogTaskUncompleted;
use App\Log;
use App\Task;
use App\User;
use Illuminate\Support\Facades\App;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogTaskUncompTletedTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * @return void
     */
    public function a_task_uncompleted_log_has_been_created()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);

        //event(new TaskUncompleted($task));

        $listener = new LogTaskUncompleted();
        $listener->handle(new \App\Events\TaskUncompleted($task));

        //        // Test log is inserted
        $log  = Log::where('loggable_id', $task->id)->first();
        //dd($log);
        $this->assertEquals($log->text, "S'ha marcat com a pendent la tasca '{$task->name}'");
        $this->assertEquals($log->action_type, 'descompletar');
        $this->assertEquals($log->module_type, 'Tasques');
        $this->assertEquals($log->user_id, $task->user_id);
        $this->assertEquals($log->old_value, true);
        $this->assertEquals($log->new_value, 0);
        $this->assertEquals($log->loggable_id, $task->id);
        $this->assertEquals($log->loggable_type, 'App\Task');
        $this->assertEquals($log->icon, 'lock_open');
        $this->assertEquals($log->color, 'primary');
    }
}
