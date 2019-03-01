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
            //SendEmailVerificationNotification::class,
            AddRolesToRegisterUser::class
        ],
        'App\Events\Tasks\TaskUncompleted' => [
            'App\Listeners\Tasks\LogTaskUncompleted',
            'App\Listeners\ForgetCachedTasks',
            'App\Listeners\Tasks\SendMailTaskUncompleted',
        ],
        'App\Events\Tasks\TaskCompleted'  => [
            'App\Listeners\Tasks\LogTaskCompleted',
            'App\Listeners\ForgetCachedTasks',
            'App\Listeners\Tasks\SendMailTaskCompleted'
        ],
        'App\Events\Tasks\TaskUpdated' => [
            'App\Listeners\Tasks\LogTaskUpdated',
            'App\Listeners\ForgetCachedTasks',
            'App\Listeners\Tasks\SendMailTaskUpdated',
        ],
        'App\Events\Tasks\TaskStored' => [
            'App\Listeners\Tasks\LogTaskStored',
            'App\Listeners\ForgetCachedTasks',
            'App\Listeners\Tasks\SendMailTaskStored',
        ],
        'App\Events\Tasks\TaskDestroyed' => [
            'App\Listeners\Tasks\LogTaskDestroyed',
            'App\Listeners\ForgetCachedTasks',
            'App\Listeners\Tasks\SendMailTaskDestroyed',
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
