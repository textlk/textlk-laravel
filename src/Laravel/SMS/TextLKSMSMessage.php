<?php

namespace TextLK\Laravel\SMS;

use Illuminate\Support\Facades\Log;

class TextLKSMSMessage
{
    protected $message;
    protected $recipient;
    protected $sender_id;
    protected $schedule_time;
    protected $api_key;
    private const API_URL = "https://app.text.lk/api/v3/";

    public function __construct()
    {
        $this->api_key = config('textlk.textlk.TEXTLK_SMS_API_KEY');
        $this->sender_id = config('textlk.textlk.TEXTLK_SMS_SENDER_ID');
        
    }

    public function message($message = "")
    {
        $this->message = $message;
        return $this;
    }

    public function recipient($recipient = "")
    {
        $this->recipient = $recipient;
        return $this;
    }
    
    public function senderId($sender_id = "")
    {
        if(!empty($sender_id)) {
            $this->sender_id = $sender_id;
        }
        return $this;
    }
    
    public function scheduleTime($schedule_time = "")
    {
        $this->schedule_time = $schedule_time;
        return $this;
    }
    
    public function apiKey($api_key = "")
    {
        if(!empty($api_key)) {
            $this->api_key = $api_key;
        }
        return $this;
    }

    public function send(array $data = [])
    {
        try {
            $message = $this->message;
            $recipient = $this->recipient;
            $sender_id = $this->sender_id;
            $schedule_time = $this->schedule_time;
            $api_key = $this->api_key;
            
            if (empty($api_key)) {
                $this->api_key = config('textlk.textlk.TEXTLK_SMS_API_KEY');
                $api_key = $this->api_key;
            }
            
            if (empty($api_key)) {
                $errorMessage = 'API key cannot be empty. Set it in the constructor or add TEXTLK_SMS_API_KEY in .env';
                throw new \InvalidArgumentException($errorMessage);
            }
            
            // Validate required parameters
            $this->validateParameter($message, 'message');
            $this->validateParameter($recipient, 'recipient');
            $this->validateParameter($sender_id, 'sender_id');
            
            $data = array(
                "recipient" => $recipient,
                "sender_id" => $sender_id,
                "message" => $message,
                "schedule_time" => $schedule_time,
            );
            
            $response = $this->sendServerResponse('sms/send', $data, 'POST');
            $response = json_decode($response);
        
            if ($response->status === 'success') {
                $successMessage = $response->message;
                Log::info("SMS to $recipient: $successMessage");
                return $response;
            } else {
                $errorMessage = $response->message;
                throw new \Exception("Failed to send SMS to $recipient. Error: $errorMessage");
            }
        } catch (\Exception $e) {
            // Handle any other exceptions
            Log::error('Exception caught: ' . $e->getMessage());
            $response = array(
                'status' => 'error',
                'message' => 'Something went wrong. Exception caught: ' . $e->getMessage()
            );
            return $response;
        }
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
            'Authorization: Bearer ' . $this->api_key,
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
    
    /**
     * Get balance for a specific user.
     *
     * @return mixed
     */
    public function getBalance()
    {
        return $this->sendServerResponse("balance", [],'GET');
    }
    
    /**
     * Get profile information.
     *
     * @return mixed
     */
    public function getProfile()
    {
        return $this->sendServerResponse("me", [], 'GET');
    }
    
    /**
     * Validate a required parameter.
     *
     * @param mixed $parameter
     * @param string $parameterName
     * @throws \InvalidArgumentException
     */
    private function validateParameter($parameter, $parameterName)
    {
        if (empty($parameter)) {
            $errorMessage = "Missing the required parameter $parameterName when calling send";
            throw new \InvalidArgumentException($errorMessage);
        }
    }
}
