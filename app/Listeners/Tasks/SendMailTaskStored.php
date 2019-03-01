<?php

namespace App\Listeners\Tasks;

use App\Events\Tasks\TaskStored;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        //
    }
}
