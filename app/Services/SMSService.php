<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class SMSService
{
    protected $apiKey;
    protected $url;
    protected $senderID;

    public function __construct()
    {
        $this->apiKey = env('SMSLIVEapiKey');
        $this->url = env('SMSLIVEurl');
        $this->senderID = env('SMSLIVESenderID'); // Default sender ID
    }

    /**
     * Send SMS message.
     *
     * @param string $phone
     * @param string $smsMessage
     * @return array|false
     */
    public function sendSMS($patientPhone, $smsMessage)
    {
        // Convert phone number to international format
        if (substr($patientPhone, 0, 1) === "0") {
            $patientPhone = "+234" . substr($patientPhone, 1);
        }

        Log::info("Phone number: " . $patientPhone);

        try {
            $client = new Client(['verify' => false]);

            $response = $client->request('POST', $this->url, [
                'headers' => [
                    'Authorization' => $this->apiKey,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'mobileNumber' => $patientPhone,
                    'messageText' => $smsMessage,
                    'senderID' => $this->senderID,
                ],
            ]);

            $responseBody = json_decode($response->getBody(), true);
            return $responseBody;
        } catch (\Exception $e) {
            Log::error("SMS sending failed: " . $e->getMessage());
            return false;
        }
    }
}
