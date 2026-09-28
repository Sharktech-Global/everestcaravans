<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

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
          $details = $this->details;

           return (new MailMessage)
           ->subject('Abreco Motors :: Thank You')
           ->view('emails.usercontact', ['details' => $details]);
        }

        public function toArray($notifiable)
        {
         return [

          ];
        }

}
