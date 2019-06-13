<?php

namespace App\Listeners\Tasks;

use App\Log;
use App\Task;
use Carbon\Carbon;
use App\Events\Tasks\TaskDestroyed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogTaskDestroyed implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TaskDestroyed  $event
     * @return void
     */
    public function handle(TaskDestroyed $event)
    {
        Log::create([
            'text' => "S'ha eliminat la tasca '" . ellipsis($event->task->name) . "'",
            'time' => Carbon::now(),
            'action_type' => 'eliminar',
            'module_type' => 'Tasques',
            'icon' => 'delete',
            'color' => 'red',
            'user_id' => $event->task->user_id,
            'loggable_id' => $event->task->id,
            'loggable_type' => Task::class,
            'old_value' => $event->task,
            'new_value' => null
        ]);
    }
}
