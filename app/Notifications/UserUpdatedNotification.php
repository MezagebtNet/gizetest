<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserUpdatedNotification extends Notification
{
    use Queueable;

    public $user;

    public $activity;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $activity)
    {
        $this->user = $user;
        $this->activity = $activity;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['database'];
        return ['database', 'broadcast'];

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
            'type' => 'admin_user_account_updated',
            // 'message' => $this->user->fullName() . ' has updated user details.',
            'user_id' => $this->user->id,
            'user_name' => $this->user->fullName(),
            'email' => $this->user->email,
            'link' => route('admin.manage.user.show', $this->user),
        ];
    }

    /* Get the broadcastable representation of the notification.
    *
    * @param  mixed  $notifiable
    * @return BroadcastMessage
    */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'type' => 'admin_user_account_updated',
            'message' => $this->user->fullName() . ' has updated user details ',//. array_shift(array_keys($this->activity->attibutes)). ' to '. array_pop(array_keys($this->activity->attibutes)) .'.',
            'user_id' => $this->user->id,
            'name' => $this->user->fullName(),
            'email' => $this->user->email,
        ]);
    }

    /**
     * Get the type of the notification being broadcast.
     *
     * @return string
     */
    public function broadcastType()
    {
        return 'broadcast.message';
    }

}
