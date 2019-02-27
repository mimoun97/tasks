<?php

namespace App\Listeners\Tasks;

use App\Events\Tasks\TaskUncompleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogTaskUncompleted
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
     * @param  TaskUncompleted  $event
     * @return void
     */
    public function handle(TaskUncompleted $event)
    {
        //
    }
}
