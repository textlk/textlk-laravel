<?php

namespace TextLK\SMS;

class TextLKMessage
{
    protected $content;
    protected $recipient;

    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    public function recipient($recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function send()
    {
        // Implement the logic to send the SMS using the TextLK API
        // You can use any HTTP client library or Laravel's HTTP client
    }
}
