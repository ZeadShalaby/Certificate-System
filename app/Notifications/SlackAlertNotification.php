<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class SlackAlertNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $messageContent;

    /**
     * Create a new notification instance.
     *
     * @param string $messageContent
     * @return void
     */
    public function __construct($messageContent)
    {
        $this->messageContent = $messageContent;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['slack']; // Send notification via Slack
    }

    /**
     * Get the Slack representation of the notification.
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->content($this->messageContent);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            // Include any data you want to store in the database
        ];
    }
}
