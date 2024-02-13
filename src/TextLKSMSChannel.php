<?php

namespace TextLK;

use Illuminate\Notifications\Notification;

class TextLKSMSChannel
{
    public function send($notifiable, Notification $notification)
    {
        $msg = $notification->toTextlk($notifiable);

        // Send the message using the TextLKSMSMessage class
        $msg->send();
    }
}