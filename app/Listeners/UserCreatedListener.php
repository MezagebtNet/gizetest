<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Models\User;
use App\Notifications\UserCreatedNotification;

use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Notification;

class UserCreatedListener
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
     * @param  UserCreatedEvent  $event
     * @return void
     */
    public function handle(UserCreatedEvent $event)
    {

        //Assign Default Roles...
        $event->user->assignRole('user');

        //assign Default permissions...
        //...

        //Log activity...
// activity()->log('New user [' . $event->user->id . '] created. @' . $event->user->created_at);


        //Send a 'new_user' notification to all Admins...
$all_admins = User::role(['super-admin', 'system-admin'])->get();

Notification::send($all_admins, new UserCreatedNotification($event->user));


        //Send a 'welcome' notification to the new user...
        Notification::send($event->user, new WelcomeNotification($event->user));

    }
}
