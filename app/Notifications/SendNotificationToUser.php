<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SendNotificationToUser extends Notification
{
    use Queueable;

    public $message;

    // Pass message when creating the notification
    public function __construct($message)
    {
        $this->message = $message;
    }


    // Delivery channels
    public function via($notifiable)
    {
        return ['database', 'mail']; // Send via both database and email
    }

    // What data to send in the database notification
    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message
        ];
    }

    // What to send in the email notification
    public function toMail($notifiable)
    {
        return (new MailMessage())
                    ->subject('New Notification')
                    ->line($this->message) // Message content for the email
                    ->line('Thank you for using our application!');
    }
}
