<?php

namespace Textlk;

use Illuminate\Notifications\Notification;

class TextLKChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toTextlk($notifiable);

        // Send the message using the TextLKMessage class
        $message->send();
    }
}