<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferEnquiry extends Mailable
{
    use Queueable, SerializesModels;
    public $text;
    public $enquiry;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $enquiry)
    {
        $this->subject = $subject;
        $this->enquiry = $enquiry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.offer_enquiry');
    }
}
