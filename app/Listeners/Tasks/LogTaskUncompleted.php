<?php

namespace App\Listeners\Tasks;

use App\Log;
use App\Task;
use Carbon\Carbon;
use App\Events\Tasks\TaskUncompleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogTaskUncompleted
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TaskUncompleted  $event
     * @return void
     */
    public function handle(TaskUncompleted $event)
    {
        Log::create([
            'text' => "S'ha marcat com a pendent la tasca '" . $event->task->name . "'",
            'time' => Carbon::now(),
            'action_type'=> 'descompletar',
            'module_type' => 'Tasques',
            'icon' => 'lock_open',
            'color' => 'primary',
            'user_id' => $event->task->user_id,
            'loggable_id' => $event->task->id,
            'loggable_type' => Task::class,
            'old_value' => true,
            'new_value' => false
        ]);
    }
}
