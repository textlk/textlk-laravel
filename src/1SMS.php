<?php

namespace TextLK;

class SMS
{
    private const API_URL = "https://app.text.lk/api/v3/";
    private $apiKey;

    public function __construct($apiKey = null)
    {
        if (!empty($apiKey)) {
            $this->apiKey = $apiKey;
        } else {
            $this->apiKey = config('textlk.textlk.TEXTLK_SMS_API_KEY');
        }
        
        if (empty($this->apiKey)) {
            // throw new \InvalidArgumentException('Missing the required parameter $api_key when calling send');
            throw new \Exception("API key cannot be empty. Must be 'new SMS(TEXTLK_SMS_API_KEY)'. or add TEXTLK_SMS_API_KEY in .env");
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


    /**
     * Send SMS using API request.
     *
     * @param array $data
     * @return mixed
     */
    public function send(array $data)
    {
        return $this->sendServerResponse('sms/send', $data, 'POST');
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
}
