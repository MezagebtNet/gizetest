<?php

namespace App\Listeners;

use App\Events\UserUpdatedEvent;
use App\Models\User;
use App\Notifications\UserUpdatedNotification;
use App\Notifications\User_AccountUpdatedNotification;
use Illuminate\Support\Facades\Notification;
use Spatie\Activitylog\Models\Activity;

class UserUpdatedListener
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
     * @param  UserUpdatedEvent  $event
     * @return void
     */
    public function handle(UserUpdatedEvent $event)
    {

        //Assign Default Roles...
        // $event->user->assignRole('user');

        //assign Default permissions...
        //...

        //Log activity...
        $activity = Activity::all()->last();

        // $activity->description; //returns 'updated'
        // $updated_user_model = $activity->subject;

        // activity()->log('User [' . $event->user->id . '] created. @' . $event->user->created_at);

        //Send a 'updated_user' notification to all Admins...
        $all_admins = User::role(['super-admin', 'system-admin'])->get();


        Notification::send($all_admins, new UserUpdatedNotification($event->user, $activity));

        //Send a 'account_updated' notification to the user...
        Notification::send($event->user, new User_AccountUpdatedNotification($event->user));

    }
}
