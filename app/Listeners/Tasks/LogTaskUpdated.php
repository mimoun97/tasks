<?php

namespace App\Listeners\Tasks;

use App\Log;
use App\Task;
use Carbon\Carbon;
use App\Events\Tasks\TaskUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogTaskUpdated implements ShouldQueue
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
     * @param  TaskUpdated  $event
     * @return void
     */
    public function handle(TaskUpdated $event)
    {
        Log::create([
            'text' => "S'ha modificat la tasca '" . $event->task->name . "'",
            'time' => Carbon::now(),
            'action_type' => 'modificar',
            'module_type' => 'Tasques',
            'icon' => 'edit',
            'color' => 'blue',
            'user_id' => $event->task->user_id,
            'loggable_id' => $event->task->id,
            'loggable_type' => Task::class,
            'old_value' => $event->task,
            'new_value' => $event->task
        ]);
    }
}
