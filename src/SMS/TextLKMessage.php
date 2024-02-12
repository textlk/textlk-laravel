<?php

namespace Textlk\SMS;

use Illuminate\Support\Facades\Log;

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
        Log::error("TextLKMessage.php");
        // Implement the logic to send the SMS using the TextLK API
        // You can use any HTTP client library or Laravel's HTTP client
    }
}
