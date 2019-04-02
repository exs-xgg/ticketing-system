<?php

  namespace App\Helpers;

  require '../vendor/autoload.php';

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;

class SMS
{
    static function send($number, $message)
    {
        // Configure client
        $config = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUzNzU5MTc4NywiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjYxMDY4LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.8lQq_WXVmxQex3bcD7ABao1JH1DKGw4b-uzb9dgn8No');
        $apiClient = new ApiClient($config);
        $messageClient = new MessageApi($apiClient);

        // Sending a SMS Message
        $sendMessageRequest1 = new SendMessageRequest([
            'phoneNumber' => $number,
            'message' => $message,
            'deviceId' => 102189
        ]);

        $sendMessages = $messageClient->sendMessages([
            $sendMessageRequest1
        ]);

        return $sendMessages;
    }
}
?>