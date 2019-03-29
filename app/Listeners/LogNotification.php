<?php

namespace App\Listeners;

use App\Events\DatabaseNotificationStored;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogNotification
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
     * @param  DatabaseNotificationStored  $event
     * @return void
     */
    public function handle(DatabaseNotificationStored $event)
    {
        Log::debug('Nova notificació enviada');
        Log::debug('Notifiable: ' . json_encode($event->notifiable));
        Log::debug('Notification: ' . json_encode($event->noification));
        Log::debug('Channel: ' . json_encode($event->channel));
        Log::debug('Response: ' . json_encode($event->response));
    }
}
