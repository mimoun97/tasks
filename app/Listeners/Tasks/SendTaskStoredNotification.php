<?php

namespace App\Listeners\Tasks;

use App\Events\Tasks\TaskStored;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Tasks\TaskStored as TaskStoredNotification;

class SendTaskStoredNotification
{
    use InteractsWithQueue;
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
        //dd("EVENT TASK: " . $event->task->user);
        //Notify::send($event->task->user);
        $event->task->user->notify(new TaskStoredNotification($event->task));
    }
}
