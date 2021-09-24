<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\SendNewUserNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
            // SendNewUserNotification::class,
        ],
        \App\Events\UserCreatedEvent::class => [
            \App\Listeners\UserCreatedListener::class,
            // \App\Listeners\UserUpdatedListener::class,
            // \App\Listeners\Listener::class,
        ],
        \App\Events\UserUpdatedEvent::class => [
            \App\Listeners\UserUpdatedListener::class,
            // \App\Listeners\UserUpdatedListener::class,
            // \App\Listeners\Listener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
