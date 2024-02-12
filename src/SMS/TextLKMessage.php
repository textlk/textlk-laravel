<?php

namespace Textlk\SMS;

use Illuminate\Support\Facades\Log;

class TextLKMessage
{
    protected $content;
    protected $recipient;

    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    public function recipient($recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function send(array $data)
    {
        // Accessing the content and recipient properties
        $content = $this->content;
        $recipient = $this->recipient;

        // Implement the logic to send the SMS using the TextLK API
        // You can use any HTTP client library or Laravel's HTTP client

        // Example: Sending an HTTP request to TextLK API
        $response = [];// Send HTTP request to TextLK API with $content and $recipient

        // Check the response and handle accordingly
        if ($response->successful()) {
            // SMS sent successfully
            // You can handle success logic here

        } else {
            // SMS sending failed
            // You can handle failure logic here
        }
        Log::error("TextLKMessage.php");

        return $this->sendServerResponse('sms/send', $data, 'POST');
        // Implement the logic to send the SMS using the TextLK API
        // You can use any HTTP client library or Laravel's HTTP client
    }

    /**
     * Send request to server and get SMS status.
     *
     * @param string $postBody
     * @return mixed
     */
    private function sendServerResponse($endpoint = "", $data = [], $method = 'POST')
    {
        $apiUrl = self::API_URL . $endpoint;
        $ch = curl_init();
    
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } elseif ($method === 'GET') {
            $apiUrl .= '?' . http_build_query($data);
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        } else {
            // Handle other HTTP methods if needed
        }
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $headers = array(
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json',
            'Accept: application/json'
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        $result = curl_exec($ch);
    
        if (curl_errno($ch)) {
            error_log("cURL Error: " . curl_error($ch));
            $result = json_encode(['status' => 'error', 'message' => 'An error occurred while sending the request.']);
        }
    
        curl_close($ch);
        
        $result = json_decode($result, true);
        if (isset($result['data']['cost'])) {
            $result['data']['cost'] = number_format($result['data']['cost'], 2);
        } else {
            $result['data']['cost'] = null;
        }
        $result = json_encode($result, JSON_PRETTY_PRINT);
        
        return $result;
    }
}
