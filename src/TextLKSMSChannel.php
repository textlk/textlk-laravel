<?php

namespace TextLK;

use Illuminate\Notifications\Notification;

class TextLKSMSChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toTextlk($notifiable);

        // Send the message using the TextLKMessage class
        $message->send();
        Log::error("TextLK\TextLKSMSChannel\send()");
    }
}