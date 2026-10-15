<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingEnquiryNotification extends Notification
{
    use Queueable;

    public function __construct(public array $details)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('New Vehicle Booking Enquiry - Everest Caravans')
        ->view('emails.booking-enquiry-admin', [
            'details' => $this->details,
        ]);
    }
}