<?php

namespace TextLK\Mail;

use Illuminate\Mail\Mailable;

class TextLKMail extends Mailable
{
    protected $subject;

    public function __construct($subject)
    {
        $this->subject = $subject;
    }

    public function build()
    {
        return $this->subject($this->subject)->view('emails.textlk');
    }
}
