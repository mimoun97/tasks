<?php

namespace App\Listeners\Tasks;

use App\Log;
use App\Task;
use Carbon\Carbon;
use App\Events\Tasks\TaskStored;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogTaskStored implements ShouldQueue
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
     * @param  TaskStored  $event
     * @return void
     */
    public function handle(TaskStored $event)
    {
        Log::create([
            'text' => "S'ha creat la tasca '" . $event->task->name . "'",
            'time' => Carbon::now(),
            'action_type' => 'crear',
            'module_type' => 'Tasques',
            'icon' => 'visibility',
            'color' => 'orange',
            'user_id' => $event->task->user_id,
            'loggable_id' => $event->task->id,
            'loggable_type' => Task::class,
            'old_value' => null,
            'new_value' => $event->task
        ]);
    }
}
