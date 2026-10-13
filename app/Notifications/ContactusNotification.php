<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactusNotification extends Notification
{
    use Queueable;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Everest Caravans :: Thank You for Contacting Us')
            ->view('emails.usercontact', [
                'details' => $this->details,
            ]);
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
