<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Batch;
use App\Models\Channelvideo;


class Admin_BatchStreamingStartedNotification extends Notification
{
    use Queueable;

    public $user;
    public $batch_channelvideo;
    public $gize_channel;

    public $channelvideo;
    public $batch;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $batch_channelvideo, $gize_channel)
    {
        $this->user = $user;
        $this->batch_channelvideo = $batch_channelvideo;
        $this->gize_channel = $gize_channel;

        $this->channelvideo = Channelvideo::find($batch_channelvideo->channelvideo_id);
        $this->batch = Batch::find($batch_channelvideo->batch_id);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['mail'];
        return ['database'];

    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'type' => 'admin_batch_streaming',
            'user_id' => $this->user->id,
            'channelvideo_id' => $this->batch_channelvideo->channelvideo_id,
            'video_title' => $this->channelvideo->title,
            'video_thumb_image' => $this->channelvideo->thumb_image_url,
            'video_available_from' => $this->batch_channelvideo->starts_at,
            'video_available_until' => $this->batch_channelvideo->ends_at,
            'batch_id' => $this->batch->id,
            'batch_name' => $this->batch->name,
            'gize_channel_id' => $this->gize_channel->id,
            'gize_channel_name' => $this->gize_channel->name,
        ];
    }
}
