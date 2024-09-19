<?php

namespace Yokithaii\CatalogSbisBitrix\Client\Bitrix;

use Yokithaii\CatalogSbisBitrix\Exception\ApiException;

class BitrixAuthClient
{
    private $clientId;
    private $clientSecret;
    private $redirectUri;
    private $authUrl;

    public function __construct($clientId, $clientSecret, $redirectUri, $authUrl)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUri = $redirectUri;
        $this->authUrl = $authUrl;
    }

    public function getAccessToken()
    {
        $params = [
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $this->redirectUri,
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $this->authUrl,
            CURLOPT_POST => true,
            CURLOPT_HEADER => 0,
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_HTTPHEADER => [
                'Content-type: application/x-www-form-urlencoded'
            ]
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            throw new ApiException('Failed to get access token from Bitrix API');
        }

        $responseData = json_decode($response, true);

        if (!isset($responseData['access_token'])) {
            throw new ApiException('Access token not found in Bitrix API response');
        }

        return $responseData['access_token'];
    }
}