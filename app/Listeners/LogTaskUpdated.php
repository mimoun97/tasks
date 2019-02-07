<?php

namespace App\Listeners;

use App\Log;
use App\Task;
use Carbon\Carbon;
use App\Events\TaskUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogTaskUpdated
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
            'text' => "S'ha actualitzat la tasca '" . $event->task->name . "'",
            'time' => Carbon::now(),
            'action_type' => 'actualitzar',
            'module_type' => 'Tasques',
            'icon' => 'cached',
            'color' => 'orange',
            'user_id' => $event->task->user_id,
            'loggable_id' => $event->task->id,
            'loggable_type' => Task::class,
            'old_value' => $event->task->name,
            'new_value' => $event->task->name
        ]);
    }
}
