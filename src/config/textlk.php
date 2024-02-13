<?php
/**
 * The TextLK Configuration - The configuration file for the TextLK.
 *
 */

return [
    'textlk' => [
        'TEXTLK_SMS_API_KEY' => env('TEXTLK_SMS_API_KEY', ''), 
        'TEXTLK_SMS_SENDER_ID' => env('TEXTLK_SMS_SENDER_ID', '')
    ],
];