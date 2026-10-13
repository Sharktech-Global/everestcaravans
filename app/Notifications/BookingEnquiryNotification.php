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
        $d = $this->details;

        return (new MailMessage)
            ->subject('New Vehicle Booking Enquiry - Everest Caravans')
            ->greeting('New Vehicle Booking Enquiry')
            ->line('A customer has submitted a vehicle booking enquiry.')
            ->line('Vehicle: ' . $d['vehicle_name'])
            ->line('Name: ' . $d['name'])
            ->line('Email: ' . $d['email'])
            ->line('Phone: ' . $d['phone'])
            ->line('Suburb: ' . $d['suburb'])
            ->line('State: ' . $d['state'])
            ->line('Postcode: ' . $d['postcode'])
            ->line('Additional Details: ' . ($d['additional_details'] ?: 'None'))
            ->salutation('Everest Caravans Website');
    }
}