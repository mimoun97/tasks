<?php

namespace App\Listeners\Tasks;

use App\Events\Tasks\TaskStored;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Tasks\TaskStored as TaskStoredMail;

class SendMailTaskStored
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
        $subject = $event->task->subject();
        Mail::to($event->task->user)
            ->cc(config('tasks.manager_email'))
            ->send((new TaskStoredMail($event->task))->subject($subject));
    }
}
