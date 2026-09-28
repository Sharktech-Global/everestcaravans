<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuccessMail extends Mailable
{
    use Queueable, SerializesModels;
    public $text;
    public $enquiry;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($text,$enquiry)
    {
        $this->text = $text;
        $this->enquiry = $enquiry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $enquiry=$this->enquiry;
        return $this->subject('AXLR8:Booking Successful!')
            ->view('emails.success',compact('enquiry'));
    }
}
