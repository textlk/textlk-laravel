<?php

namespace TextLK;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class TextLKSMSChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toTextlk($notifiable);

        // Send the message using the TextLKMessage class
        $message->send();
        Log::error(json_encode($notifiable));
    }
}