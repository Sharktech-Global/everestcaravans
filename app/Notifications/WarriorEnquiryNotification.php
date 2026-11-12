<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class WarriorEnquiryNotification extends Notification
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
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Everest Caravans :: New Warrior Landing Page Enquiry')
            ->view('emails.warrior-enquiry', [
                'details' => $this->details,
            ]);
    }
}
