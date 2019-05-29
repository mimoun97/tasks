<?php

namespace App\Listeners\Tasks;

use App\Events\Tasks\TaskCompleted;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Tasks\TaskCompleted as TaskCompletedMail;
use App\User;

class SendMailTaskCompleted
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
        $subject = $event->task->subject();
        Mail::to($event->task->user)
            ->cc(config('tasks.manager_email'))
            ->send((new TaskCompletedMail($event->task))->subject($subject));
    }
}
