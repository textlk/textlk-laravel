<?php

namespace TextLK\Email;

class TextLKEmailMessage
{
    protected $subject;
    protected $recipient;

    public function subject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function recipient($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }

    public function send()
    {
        // Implement the logic to send the email using the TextLK API
        // You can use any email sending library or Laravel's Mail facade

        // Example: Sending an email using Laravel's Mail facade
        \Mail::to($this->recipient)->send(new \App\Mail\TextLKMail($this->subject));

        // Check the response and handle accordingly
        // Note: You might need to adjust this based on the specifics of the TextLK email API
    }
}
