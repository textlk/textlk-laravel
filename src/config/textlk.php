<?php
/**
 * The Sms Gateway Configuration - The configuration file for the SMS Gateway.
 *
 * PHP version 7.1
 *
 * @category PHP/Laravel
 * @package  Iyngaran_SmsGateway
 * @author   Iyathurai Iyngaran <dev@iyngaran.info>
 * @link     https://github.com/iyngaran/laravel-sms-gateway
 */

return [
    'textlk' => [
        'TEXTLK_SMS_API_KEY' => env('TEXTLK_SMS_API_KEY', ''), 
    ],
];