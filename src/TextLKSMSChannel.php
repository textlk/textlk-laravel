<?php

namespace TextLK;

use Illuminate\Notifications\Notification;

class TextLKSMSChannel
{
    public function send($notifiable, Notification $notification)
    {
        $msg = $notification->toTextlk($notifiable);

        // Send the message using the TextLKMessage class
        $msg->send();
    }
}