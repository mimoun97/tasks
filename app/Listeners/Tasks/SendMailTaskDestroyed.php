<?php

namespace App\Listeners\Tasks;

use App\Events\Tasks\TaskDestroyed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Tasks\TaskDestroyed as TaskDestroyedMail;

class SendMailTaskDestroyed
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
     * @param  TaskDestroyed  $event
     * @return void
     */
    public function handle(TaskDestroyed $event)
    {
        $subject = $event->task->subject();
        Mail::to($event->task->user)
            ->cc(config('tasks.manager_email'))
            ->send((new TaskDestroyedMail($event->task))->subject($subject));
    }
}
