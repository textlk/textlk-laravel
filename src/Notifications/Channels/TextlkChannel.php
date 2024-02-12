<?php

namespace Textlk\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Textlk\SMS;

class TextlkChannel
{
    public function send($notifiable, Notification $notification)
    {
        // Logic to send the notification via Textlk
        Log::error("Logic to send the notification via Textlk TextlkChannel. Modified.");
        Log::error(json_encode($notifiable));
        $api_key = '2|3SwUUnFUfqJm09VcxCPnHeYgY5mV4LkJQdyHTISN29f88d3e';

        // Instantiate Textlk\SMS with the required arguments
        $SMS = new SMS($api_key);

        $data = array(
            "recipient" => "94764880118", // or have multiple numbers: "recipient" => "+9476000000,+9476111000"
            "sender_id" => "TEXTLK",
            "type" => "plain",
            "message" => "Boom! Message from Text.lk"
            // "schedule_time" => "2021-12-20T07:00:00Z"
        );

        $response = $SMS->send($data);
        Log::error($response);
    }
} 