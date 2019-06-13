<?php

namespace App\Listeners\Tasks;

use Illuminate\Support\Facades\Mail;
use App\Events\Tasks\TaskUncompleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Tasks\TaskUncompleted as TaskUncompletedMail;

class SendMailTaskUncompleted
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
     * @param  TaskUncompleted  $event
     * @return void
     */
    public function handle(TaskUncompleted $event)
    {
        $subject = $event->task->subject();
        Mail::to($event->task->user)
            ->cc(config('tasks.manager_email'))
            ->send((new TaskUncompletedMail($event->task))->subject($subject));
    }
}
