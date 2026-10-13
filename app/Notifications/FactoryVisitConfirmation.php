<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FactoryVisitConfirmation extends Notification
{
    use Queueable;

    public function __construct(public $details)
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Everest Caravans :: Factory Visit Request Received')
            ->view('emails.factory-visit-confirmation', [
                'details' => $this->details,
            ]);
    }
}
