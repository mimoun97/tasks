<?php

namespace App\Listeners\Tasks;

use App\Events\Tasks\TaskDestroyed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogTaskDestroyed
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
     * @param  TaskDestroyed  $event
     * @return void
     */
    public function handle(TaskDestroyed $event)
    {
        //
    }
}
