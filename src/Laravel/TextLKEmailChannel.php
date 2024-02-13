<?php

namespace TextLK\Laravel;

use Illuminate\Mail\Mailable;

class TextLKEmailChannel
{
    public function send($notifiable, Mailable $mailable)
    {
        $message = $mailable->toTextlkEmail();

        // Send the email using the TextLKEmailMessage class
        $message->send();
    }
}
