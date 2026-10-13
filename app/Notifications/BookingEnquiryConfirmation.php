<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingEnquiryConfirmation extends Notification
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
        $d = $this->details;

        return (new MailMessage)
            ->subject('Vehicle Booking Enquiry Received - Everest Caravans')
            ->greeting('Dear ' . $d['name'] . ',')
            ->line('Thank you for your interest in Everest Caravans.')
            ->line('We have successfully received your booking enquiry for:')
            ->line($d['vehicle_name'])
            ->line('Our team will review your enquiry and contact you as soon as possible.')
            ->line('If you have any additional questions, please feel free to contact us.')
            ->salutation('Best regards, Everest Caravans Team');
    }
}