<?php

namespace Textlk\Notifications;

use Illuminate\Notifications\Notification;
use Textlk\SMS\TextLKMessage;

class TextLKNotification extends Notification
{
    public function toTextlk($notifiable)
    {
        // Customize this according to your TextLK integration
        return (new TextLKMessage)
            ->content('Your SMS content here')
            ->recipient($notifiable->phone); // Assuming there's a phone attribute on the notifiable model
    }
}
