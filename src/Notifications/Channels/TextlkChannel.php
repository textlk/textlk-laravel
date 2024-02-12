<?php

namespace Textlk\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class TextlkChannel
{
    public function send($notifiable, Notification $notification)
    {
        // Logic to send the notification via Textlk
        Log::error("Logic to send the notification via Textlk TextlkChannel. Textlk\Notifications\Channels\TextlkChannel");
    }
} 