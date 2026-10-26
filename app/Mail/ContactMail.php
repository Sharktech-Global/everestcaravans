<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $admin;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin, $data)
    {
        $this->admin = $admin;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $admin = $this->admin;
        $data = $this->data;
        return $this->subject('Everest Caravans : New Enquiry')
            ->view('emails.enquiry',compact('admin','data'));
    }
}
