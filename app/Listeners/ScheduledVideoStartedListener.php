<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ScheduledVideoStarted;
use App\Models\User;

class ScheduledVideoStartedListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(ScheduledVideoStarted $event)
    {
        $batch_id = $event->batch_channelvideo->batch_id;
        $channelvideo_id = $event->batch_channelvideo->channelvideo_id;
        $gize_channel = GizeChannel::find(Channelvideo::find($channelvideo_id)->first()->value('gize_channel_id'));

        //Send a 'batch_streaming_started' notification to all Admins...
        $all_admins = User::role(['super-admin', 'system-admin'])->get();
        Notification::send($all_admins, new Admin_BatchStreamingStartedNotification($event->user, $event->batch_channelvideo, $gize_channel));

        // //Send a 'batch_streaming_started' notification to Channel Admins...
        // $channel_admins = User::role(['super-admin', 'system-admin'])->get();
        // Notification::send($all_admins, new UserCreatedNotification($event->user));

        // $batch_users = User::role(['super-admin', 'system-admin'])->get();
        // Notification::send($event->user, new WelcomeNotification($event->user));

    }
}
