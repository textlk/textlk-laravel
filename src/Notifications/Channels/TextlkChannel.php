<?php

namespace Textlk\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Textlk\SMS;

class TextlkChannel
{
    public function send($notifiable, Notification $notification)
    {
        Log::error("Logic to send the notification via Textlk TextlkChannel. Composer module");
        Log::error(json_encode($notifiable));
        Log::error(json_encode($notification));
        
        return (new SMS())->send([
            "recipient" => "94764880118", // or have multiple numbers: "recipient" => "+9476000000,+9476111000"
            "sender_id" => "TEXTLK",
            // "type" => "plain",
            "message" => "Boom! Message from Text.lk"
            // "schedule_time" => "2021-12-20T07:00:00Z"
        ]);


        //  // Logic to send the notification via Textlk
        //  $SMS = new SMS();
        //  $data = array(
        //      "recipient" => "94764880118", // or have multiple numbers: "recipient" => "+9476000000,+9476111000"
        //      "sender_id" => "TEXTLK",
        //      // "type" => "plain",
        //      "message" => "Boom! Message from Text.lk"
        //      // "schedule_time" => "2021-12-20T07:00:00Z"
        //  );
        //  return $SMS->send($data);
    }
} 