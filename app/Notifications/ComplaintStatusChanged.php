<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;


class ComplaintStatusChanged extends Notification
{
    use Queueable;


    protected $complaint;

    /**
     * Create a new notification instance.
     */
    public function __construct($complaint)
    {
        $this->complaint = $complaint;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    // public function via(object $notifiable): array
    // {
    //     return ['mail'];
    // }

    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast']; 
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Complaint Status Updated')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your complaint (ID: ' . $this->complaint->id . ') status has been updated to: ' . $this->complaint->status)
            ->action('View Complaint', url('/complaints/' . $this->complaint->id))
            ->line('Thank you for using our service.');
    }
    

     /**
     * Store notification in the database.
     */
    public function toDatabase($notifiable)
    {
        return [
            'complaint_id' => $this->complaint->id,
            'status' => $this->complaint->status,
            'message' => 'Your complaint status has been updated to ' . $this->complaint->status,
        ];
    }

    /**
     * Broadcast the notification for real-time updates.
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'complaint_id' => $this->complaint->id,
            'status' => $this->complaint->status,
            'message' => 'Your complaint status has been updated to ' . $this->complaint->status,
        ]);
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
