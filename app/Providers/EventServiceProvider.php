<?php

namespace App\Providers;

use App\Events\TaskUncompleted;
use App\Listeners\AddRolesToRegisterUser;
use App\Listeners\LogTaskUncompleted;
use App\Listeners\SendMailTaskUncompleted;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            AddRolesToRegisterUser::class
        ],
        TaskUncompleted::class => [
            LogTaskUncompleted::class,
            //SendMailTaskUncompleted::class
        ],
        \App\Events\TaskCompleted::class  => [
            \App\Listeners\LogTaskCompleted::class,
            \App\Listeners\ForgetCachedTasks::class,
            //\App\Listeners\SendMailTaskCompleted::class
        ],
        \App\Events\TaskUpdated::class => [
            \App\Listeners\LogTaskUpdated::class,
            //\App\Listeners\SendMailTaskUpdated::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
