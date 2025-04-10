<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewNoticeNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

     protected $notice;

    public function __construct($notice)
    {
        $this->notice = $notice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
     public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('📢 New Notice Posted: ' . $this->notice->title)
                    ->line('A new notice has been posted in the community.')
                    ->line('Title: ' . $this->notice->title)
                    ->action('View Notice', url(route('notices.show', $this->notice->id)))
                    ->line('Thank you for staying informed!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
