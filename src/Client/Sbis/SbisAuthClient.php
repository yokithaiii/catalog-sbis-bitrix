<?php

namespace Yokithaiii\CatalogSbisBitrix\Client\Sbis;

use Yokithaiii\CatalogSbisBitrix\Exception\ApiException;

class SbisAuthClient
{
    private $appClientId;
    private $appSecret;
    private $secretKey;

    public function __construct($appClientId, $appSecret, $secretKey)
    {
        $this->appClientId = $appClientId;
        $this->appSecret = $appSecret;
        $this->secretKey = $secretKey;
    }

    public function getAccessToken()
    {
        $authData = [
            'app_client_id' => $this->appClientId,
            'app_secret' => $this->appSecret,
            'secret_key' => $this->secretKey,
        ];

        $authDataJson = json_encode($authData);

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => 'https://online.sbis.ru/oauth/service/',
            CURLOPT_POST => true,
            CURLOPT_HEADER => 0,
            CURLOPT_POSTFIELDS => $authDataJson,
            CURLOPT_HTTPHEADER =>  [
                'Content-type: application/json'
            ]
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            throw new ApiException('Failed to get access token.');
        }

        $responseData = json_decode($response, true);

        if (!isset($responseData['access_token'])) {
            throw new ApiException('Access token not found.');
        }

        return $responseData['access_token'];
    }
}