<?php

namespace App\Listeners;

use App\Log;
use App\Task;
use Carbon\Carbon;
use App\Events\TaskCompleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogTaskCompleted
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
     * @param  TaskCompleted  $event
     * @return void
     */
    public function handle(TaskCompleted $event)
    {
        Log::create([
            'text' => "S'ha marcat com a completada la tasca '" . $event->task->name . "'",
            'time' => Carbon::now(),
            'action_type' => 'completar',
            'module_type' => 'Tasques',
            'icon' => 'lock',
            'color' => 'indigo',
            'user_id' => $event->task->user_id,
            'loggable_id' => $event->task->id,
            'loggable_type' => Task::class,
            'old_value' => false,
            'new_value' => true
        ]);
    }
}
